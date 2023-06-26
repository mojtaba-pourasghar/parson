@extends('layouts.default')
@section('title',$slider->exists ? __('slider.edit').' '.$slider->name : __('slider.add'))

@section('content')
    <script type="text/javascript" src="{{ backendTheme('js/ckeditor415/ckeditor.js') }}"></script>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$slider->exists ? __('slider.edit').' '.$slider->name : __('slider.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($slider, [
                            'route' => $slider->exists ? ['backend.sliders.update', $slider->id] : ['backend.sliders.store'],
                            'method' => $slider->exists ? 'put' : 'post','class' => 'form-horizontal','files'=>'true'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('slider.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('slider.url'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('url', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('slider.order'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::number('order', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('slider.images'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                <div class="well clearfix">
                                    <a class="btn btn-primary pull-right add_image_row" data-added="0">
                                        <i class="glyphicon glyphicon-plus"></i>@lang('slider.add_image_row')
                                    </a>
                                </div>
                                <table class="table table-bordered" id="tbl_images">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('slider.image')</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbl_images_body">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('slider.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $slider->state, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                {!! Form::submit(__('message.save'), ['class' => 'btn btn-primary']) !!}
                                {!! Form::reset( __('message.reset')  , ['class' => 'btn btn-white']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="display:none;">


        <table id="sample_image_table">
            <tr id="">
                <td><span class="sn"></span>.</td>
                <td>
                    {!! Form::file('images[]', null, ['class' => 'form-control image','id'=>'image','data-id'=>'0']) !!}
                    <input type="hidden" value="" name="old_images[]" class="old_image">
                </td>
                <td><img src="" id="current_image" style="width: 400px;height: 200px" class="current_image form-control"/></td>
                <td><input name="image_titles[]" style="width: 200px;" placeholder="@lang('slider.title')" class="current_title form-control"/></td>
                <td><a class="btn btn-xs delete_image_row" data-id="0"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        </table>
    </div>

    <script type="text/javascript" src="{{ backendTheme('js/slider.js') }}"></script>
    @foreach( $slider->images as $image)
        <script>
            var id = jQuery('#tbl_images_body >tr').length + 1;
            editImageRecord(id, '{{ getSliderImagePath($image->image) }}', '{{ $image->image }}', '{{ $image->title }}');
        </script>
    @endforeach
    <script>
        jQuery(document).delegate('a.add_image_row', 'click', function (e) {
            e.preventDefault();
            addImageRecord(jQuery('#tbl_images >tbody >tr').length + 1);
        });
        jQuery(document).delegate('a.delete_image_row', 'click', function (e) {
            e.preventDefault();
            deleteImageRecord(jQuery(this), '{{ __('message.are_you_sure') }}')
        });
    </script>

@endsection



