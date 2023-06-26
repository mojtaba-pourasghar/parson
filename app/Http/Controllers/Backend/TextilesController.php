<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\DiscountType;
use App\HashTag;
use App\Http\Requests\UpdateTextileRequest;
use App\PricePattern;
use App\Textile;
use App\Http\Requests\StoreTextileRequest;
use App\TextileColor;
use App\TextileImage;
use App\TextileType;
use DB;
use Illuminate\Http\Request;

class TextilesController extends Controller
{
    protected $textiles;
    protected $path;

    public function __construct(Textile $textiles)
    {
        $this->textiles = $textiles;
        $this->path = getConstant('options.upload_path') . '/textiles';
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $textiles = $this->textiles
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->orderBy('id', 'desc')
                ->paginate($limit);
        } else {
            $textiles = $this->textiles->orderBy('id', 'desc')->paginate($limit);
        }
        $path = $this->path;
        return view(currentBackView('textiles.index'), compact('textiles', 'path'));
    }

    public function create(Textile $textile)
    {
        $path = $this->path;
        $categories = Category::getList();
        $selected_categories = [];

        $discount_types = DiscountType::getList();
        $selected_discount_types = [];

        $textile_types = TextileType::getList();

        $hashtags = HashTag::getList();

        $pps = PricePattern::getList();
        $price_patterns[] = __('price_pattern.please_enter_discount_title');
        foreach ($pps as $price_pattern){
            $price_patterns[] =  $price_pattern;
        }
        return view(currentBackView('textiles.form'), compact('price_patterns','textile', 'path', 'categories', 'selected_categories', 'textile_types', 'discount_types', 'selected_discount_types','hashtags'));
    }

    private function _getPricePatternItemIds($request)
    {
        $data = [];
        if (!empty($request->prices)) {
            foreach ($request->prices as $key => $price) {
                $data[] = ['price' => $price, 'price_pattern_item_id' => $request->price_pattern_item_ids[$key]];
            }
        }
        return $data;
    }

    public function store(StoreTextileRequest $request)
    {
        // print_r($request->file('images'));
        // exit();
        DB::beginTransaction();
        try {
            $textile = $this->textiles->create(['user_id' => auth()->id()] + $request->only($this->_getFields()));

            $textile->categories()->attach($request->category_ids);
            $textile->discount_types()->attach($request->discount_type_ids);

            if (!empty($request->color_codes)) {
                foreach ($request->color_codes as $key => $color_code) {
                    $TextileColor = new TextileColor();
                    $TextileColor->textile_id = $textile->id;
                    $TextileColor->color_code = $color_code;
                    $textile->colors()->save($TextileColor);
                }
            }
            // print_r($_FILES);exit();
            if ($request->hasFile('images')) {

                $files = array();
                foreach ($_FILES['images'] as $k => $l) {
                    foreach ($l as $i => $v) {
                        if (!array_key_exists($i, $files))
                            $files[$i] = array();
                        $files[$i][$k] = $v;
                    }
                }

                foreach ($files as $file) {
                    $uploaded_image = $this->uploadImage($file, $this->path);
                    if (!$uploaded_image['action']) {
                        return redirect() . back() . with('status', $uploaded_image['message']);
                    }

                    $TextileImage = new TextileImage();
                    $TextileImage->textile_id = $textile->id;
                    $TextileImage->image = $uploaded_image['filename'];
                    $textile->images()->save($TextileImage);
                }
            }

            $data = $this->_getPricePatternItemIds($request);
            if (!empty($data)) {
                $textile->price_pattern_items()->attach($data);
            }

            DB::commit();
            return redirect(route('backend.textiles.index'))->with('status', __('textile.textile_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            if ($request->hasFile('images')) {
                foreach ($files as $file) {
                    @unlink($this->path . '/' . $file['name']);
                }
            }
            return redirect(route('backend.textiles.index'))->with('error', __('textile.textile_dont_saved'));
        }
    }

    private function _getFields()
    {
        return [
            'user_id', 'textile_type_id', 'title', 'state', 'slug', 'description', 'seo_title', 'seo_description', 'barcode', 'available_amount', 'unit_measurement',
            'price', 'weight', 'wide', 'construction', 'shrinking_volume', 'view_count','price_pattern_id','static','thickness','ware','design','hashtag_id'
        ];
    }


    public function edit($id)
    {
        $textile = $this->textiles->findOrFail($id);
        $path = $this->path;
        $categories = Category::getList();

        $selected_categories = [];
        foreach ($textile->categories as $category) {
            $selected_categories[] = $category->id;
        }

        $discount_types = DiscountType::getList();
        $selected_discount_types = [];
        foreach ($textile->discount_types as $discount_type) {
            $selected_discount_types[] = $discount_type->id;
        }



        $textile_types = TextileType::getList();
        $hashtags = HashTag::getList();

        $pps = PricePattern::getList();
        $price_patterns[] = __('price_pattern.please_enter_discount_title');
        foreach ($pps as $price_pattern){
            $price_patterns[] =  $price_pattern;
        }

        return view(currentBackView('textiles.form'), compact('price_patterns','textile_types', 'textile', 'path', 'categories', 'selected_categories', 'selected_discount_types', 'discount_types', 'hashtags'));
    }

    public function update(UpdateTextileRequest $request, $id)
    {
        $textile = $this->textiles->findOrFail($id);

        DB::beginTransaction();
        try {

            $textile->fill($request->only($this->_getFields()))->save();

            $textile->categories()->sync($request->category_ids);
            $textile->discount_types()->sync($request->discount_type_ids);

            $textile->colors()->delete();
            if (!empty($request->color_codes)) {
                foreach ($request->color_codes as $key => $color_code) {
                    $TextileColor = new TextileColor();
                    $TextileColor->textile_id = $textile->id;
                    $TextileColor->color_code = $color_code;
                    $textile->colors()->save($TextileColor);
                }
            }

            foreach ($textile->images as $current_image) {
                if (!in_array($current_image->image, $request->old_images)) {
                    $textile_image = new TextileImage();
                    $textile_image = $textile_image->findOrFail($current_image->id);
                    $textile_image->delete();
                    @unlink($this->path . '/' . $current_image->image);
                }
            }

            if ($request->hasFile('images')) {

                $files = array();
                foreach ($_FILES['images'] as $k => $l) {
                    foreach ($l as $i => $v) {
                        if (!array_key_exists($i, $files))
                            $files[$i] = array();
                        $files[$i][$k] = $v;
                    }
                }
                foreach ($files as $file) {
                    //print_r($file);exit();
                    if ($file['name'] == '') continue;
                    $uploaded_image = $this->uploadImage($file, $this->path);
                    if (!$uploaded_image['action']) {
                        return redirect() . back() . with('status', $uploaded_image['message']);
                    }

                    $TextileImage = new TextileImage();
                    $TextileImage->textile_id = $textile->id;
                    $TextileImage->image = $uploaded_image['filename'];
                    $textile->images()->save($TextileImage);
                }
            }

            $data = $this->_getPricePatternItemIds($request);
            if (!empty($data)) {
                $textile->price_pattern_items()->detach();
                $textile->price_pattern_items()->attach($data);
            }else $textile->price_pattern_items()->detach();

            DB::commit();
            return redirect(route('backend.textiles.index'))->with('status', __('textile.textile_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            if ($request->hasFile('images')) {
                foreach ($files as $file) {
                    @unlink($this->path . '/' . $file['name']);
                }
            }
            return redirect(route('backend.textiles.index'))->with('error', __('textile.textile_dont_saved'));
        }
    }

    public function delete(Request $request, $id)
    {
        $textile = $this->textiles->findOrFail($id);

        foreach ($textile->images as $image) {
            @unlink($this->path . '/' . $image->image);
        }

        $textile->delete();
        return redirect(route('backend.textiles.index'))->with('status', __('textile.textile_has_been_deleted'));
    }
}
