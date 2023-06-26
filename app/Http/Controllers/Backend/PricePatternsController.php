<?php

namespace App\Http\Controllers\Backend;

use App\PricePattern;
use App\Http\Requests\StorePricePatternRequest;
use App\PricePatternItem;
use DB;
use Illuminate\Http\Request;

class PricePatternsController extends Controller
{
    protected $pricepatterns;

    public function __construct(PricePattern $pricepatterns)
    {
        $this->pricepatterns = $pricepatterns;
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $pricepatterns = $this->pricepatterns
                ->where([['title', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $pricepatterns = $this->pricepatterns->paginate($limit);
        }

        return view(currentBackView('pricepatterns.index'), compact('pricepatterns'));
    }

    public function create(PricePattern $pricepattern)
    {
        return view(currentBackView('pricepatterns.form'), compact('pricepattern'));
    }

    public function store(StorePricePatternRequest $request)
    {

        DB::beginTransaction();
        try {
            $pricepattern = $this->pricepatterns->create($request->only('title', 'state', 'unit_measurement'));
            if (!empty($request->mins)) {
                foreach ($request->mins as $key => $min) {
                    $PricePatternItem = new PricePatternItem();
                    $PricePatternItem->price_pattern_id = $pricepattern->id;
                    $PricePatternItem->min = $min;
                    $PricePatternItem->max = $request->maxs[$key];;
                    $PricePatternItem->off = $request->offs[$key];;
                    $pricepattern->pattern_items()->save($PricePatternItem);
                }
            }
            DB::commit();
            return redirect(route('backend.pricepatterns.index'))->with('status', __('price_pattern.price_pattern_not_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            return redirect(route('backend.pricepatterns.index'))->with('error', __('price_pattern.textile_dont_saved'));
        }
    }


    public function edit($id)
    {
        $pricepattern = $this->pricepatterns->findOrFail($id);
        return view(currentBackView('pricepatterns.form'), compact('pricepattern'));
    }

    public function update(StorePricePatternRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $pricepattern = $this->pricepatterns->findOrFail($id);
            $pricepattern->fill($request->only('title', 'state', 'unit_measurement'))->save();

            $pricepattern->pattern_items()->delete();

            if (!empty($request->mins)) {
                foreach ($request->mins as $key => $min) {
                    $PricePatternItem = new PricePatternItem();
                    $PricePatternItem->price_pattern_id = $pricepattern->id;
                    $PricePatternItem->min = $min;
                    $PricePatternItem->max = $request->maxs[$key];;
                    $PricePatternItem->off = $request->offs[$key];;
                    $pricepattern->pattern_items()->save($PricePatternItem);
                }
            }
            DB::commit();
            return redirect(route('backend.pricepatterns.index'))->with('status', __('price_pattern.price_pattern_not_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            return redirect(route('backend.pricepatterns.index'))->with('error', __('price_pattern.textile_dont_saved'));
        }
    }

    public function delete(Request $request, $id)
    {
        $pricepattern = $this->pricepatterns->findOrFail($id);
        $pricepattern->delete();
        return redirect(route('backend.pricepatterns.index'))->with('status', __('price_pattern.price_pattern_has_been_deleted'));
    }

    public function get($id)
    {
        $textile_id = $_REQUEST['textile_id'];

        $price_pattern_items = PricePatternItem::
        with('values')
            ->where('price_pattern_id', $id)
            /*->whereHas('values', function ($query) use ($textile_id) {
                $query->where('textile_id', $textile_id);
            })*/
             ->with([
                 'values' => function ($query) use ($textile_id) {
                     return $query->where('textile_id', $textile_id);
                 }])
            ->get();
        //return $price_pattern_items;
        $returnHTML = view(currentBackView('partials.pricepatterns.get'))->with(['price_pattern_items' => $price_pattern_items, 'price' => $_REQUEST['price']])->render();
        // return $returnHTML;
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }
}
