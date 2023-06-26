<?php

namespace App\Http\Controllers\Backend;

use App\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\SliderImage;
use DB;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    protected $sliders;
    protected $path;

    public function __construct(Slider $sliders)
    {
        $this->sliders = $sliders;
        $this->path = getConstant('options.upload_path') . '/sliders';
        parent::__construct();
    }

    public function index()
    {
        if (isset($_REQUEST['filter'])) {
            $limit = $_REQUEST['filter'];
        } else
            $limit = getConstant('backend.limit');

        if (!empty(request()->all())) {
            $sliders = $this->sliders
                ->where([['question', 'like', '%' . request()->input('search') . '%']])
                ->paginate($limit);
        } else {
            $sliders = $this->sliders->paginate($limit);
        }

        return view(currentBackView('sliders.index'), compact('sliders'));
    }

    public function create(Slider $slider)
    {
        $path = $this->path;
        return view(currentBackView('sliders.form'), compact('slider','path'));
    }

    public function store(StoreSliderRequest $request)
    {

        DB::beginTransaction();
        try {
            $slider = $this->sliders->create($request->only('title', 'url', 'order', 'state'));
            if ($request->hasFile('images')) {

                $files = array();
                foreach ($_FILES['images'] as $k => $l) {
                    foreach ($l as $i => $v) {
                        if (!array_key_exists($i, $files))
                            $files[$i] = array();
                        $files[$i][$k] = $v;
                    }
                }

                foreach ($files as $key=>$file) {
                    $uploaded_image = $this->uploadImage($file, $this->path,true,1300);
                    if (!$uploaded_image['action']) {
                        return redirect() . back() . with('status', $uploaded_image['message']);
                    }

                    $SliderImage = new SliderImage();
                    $SliderImage->slider_id = $slider->id;
                    $SliderImage->title = $request->image_titles[$key];
                    $SliderImage->image = $uploaded_image['filename'];
                    $slider->images()->save($SliderImage);
                }
            }
            DB::commit();
            return redirect(route('backend.sliders.index'))->with('status', __('slider.slider_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            if ($request->hasFile('images')) {
                foreach ($files as $file) {
                    @unlink($this->path . '/' . $file['name']);
                }
            }
            return redirect(route('backend.sliders.index'))->with('error', __('slider.slider_dont_saved'));
        }

    }


    public function edit($id)
    {
        $slider = $this->sliders->findOrFail($id);
        $path = $this->path;
        return view(currentBackView('sliders.form'), compact('slider','path'));
    }

    public function update(StoreSliderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $slider = $this->sliders->findOrFail($id);
            $slider->fill($request->only('title', 'url', 'order', 'state'))->save();
            foreach ($slider->images as $key => $current_image) {
                $slider_image = new SliderImage();
                $slider_image = $slider_image->findOrFail($current_image->id);
                if (!in_array($current_image->image, $request->old_images)) {

                    $slider_image->delete();
                    @unlink($this->path . '/' . $current_image->image);
                }
                else{
                    $slider_image->title = $request->image_titles[$key];
                    $slider_image->save();
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
                foreach ($files as $key => $file) {
                    //print_r($file);exit();
                    if ($file['name'] == '') continue;
                    $uploaded_image = $this->uploadImage($file, $this->path);
                    if (!$uploaded_image['action']) {
                        return redirect() . back() . with('status', $uploaded_image['message']);
                    }

                    $SliderImage = new SliderImage();
                    $SliderImage->slider_id = $slider->id;
                    $SliderImage->title = $request->image_titles[$key];
                    $SliderImage->image = $uploaded_image['filename'];
                    $slider->images()->save($SliderImage);
                }
            }


            DB::commit();
            return redirect(route('backend.sliders.index'))->with('status', __('slider.slider_has_been_saved'));
        } catch (\QueryException $e) {
            DB::rollBack();
            if ($request->hasFile('images')) {
                foreach ($files as $file) {
                    @unlink($this->path . '/' . $file['name']);
                }
            }
            return redirect(route('backend.sliders.index'))->with('error', __('slider.slider_dont_saved'));
        }

    }

    public function delete(Request $request, $id)
    {
        $slider = $this->sliders->findOrFail($id);

        foreach ($slider->images as $image) {
            @unlink($this->path . '/' . $image->image);
        }

        $slider->delete();
        return redirect(route('backend.sliders.index'))->with('status', __('slider.slider_has_been_deleted'));
    }
}
