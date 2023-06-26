@extends('layouts.default')
@section('title',$textile->exists ? __('textile.edit').' '.$textile->name : __('textile.add'))

<script type="text/javascript" src="{{ backendTheme('js/jscolor.js') }}"></script>
@section('content')
    <script type="text/javascript" src="{{ backendTheme('js/ckeditor415/ckeditor.js') }}"></script>

    <link href="{{ backendTheme('css/plugins/chosen/chosen.css') }}" rel="stylesheet">
    <link href="{{ backendTheme('css/plugins/persian-datepicker/persian-datepicker.min.css') }}" rel="stylesheet">
    <style>
        .current_image {
            width: 100px;
            height: 80px;
        }
    </style>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$textile->exists ? __('textile.edit').' '.$textile->name : __('textile.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($textile, [
                            'route' => $textile->exists ? ['backend.textiles.update', $textile->id] : ['backend.textiles.store'],
                            'method' => $textile->exists ? 'put' : 'post','class' => 'form-horizontal','files'=>'true'] ) !!}
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-1"
                                       aria-expanded="false">@lang('textile.textile_information')</a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#tab-2"
                                       aria-expanded="false">@lang('textile.other_information')</a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            {!! Form::label(__('textile.title'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-6">
                                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.slug'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-6">
                                                {!! Form::text('slug', null, ['class' => 'form-control','style'=>'direction:ltr','id'=>'slug']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.barcode'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-5">
                                                {!! Form::text('barcode', null, ['class' => 'form-control','style'=>'direction:ltr','id'=>'barcode']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.available_amount'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-4">
                                                {!! Form::text('available_amount', null, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-sm-1">
                                                {!! Form::select('unit_measurement',[
                                                    'METER' =>__('textile.meter'),
                                                    'YARD' =>__('textile.yard'),
                                                ], $textile->unit_measurement, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.price'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('price', null, ['class' => 'form-control','id'=>'price']) !!}
                                            </div>
                                            {!! Form::label(__('textile.rial'),null,['class' => 'col-sm-1 control-label']) !!}
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.price_pattern'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::select('price_pattern_id', $price_patterns , $textile->price_pattern_id,['class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'price_pattern_id']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group" id="price_item_place">

                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('category.category'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-5">
                                                {!! Form::select('category_ids[]',$categories , $selected_categories, ['data-placeholder'=>__('category.please_enter_category_title'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'category_id','multiple'=>'multiple']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.discount_type'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-5">
                                                {!! Form::select('discount_type_ids[]',$discount_types , $selected_discount_types, ['data-placeholder'=>__('discount_type.please_enter_discount_title'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'discount_type_id','multiple'=>'multiple']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.textile_type'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::select('textile_type_id',$textile_types, $textile->textile_type_id,['class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'textile_type_id']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.hashtag'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::select('hashtag_id',$hashtags, $textile->hashtag_id,['class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'hashtag_id']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.weight'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('weight', null, ['class' => 'form-control']) !!}
                                            </div>
                                            {!! Form::label(__('textile.gram'),null,['class' => 'col-sm-1 control-label']) !!}
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.wide'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('wide', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.static'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('static', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.thickness'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('thickness', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.ware'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('ware', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.design'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('design', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.construction'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('construction', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.shrinking_volume'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-3">
                                                {!! Form::text('shrinking_volume', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.state'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-2">
                                                {!! Form::select('state',[
                                                    '1'=>__('message.active'),
                                                    '0' =>__('message.deactive'),
                                                ], $textile->state, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.colors'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-4">
                                                <div class="well clearfix">
                                                    <a class="btn btn-primary pull-right add_color_row" data-added="0">
                                                        <i class="glyphicon glyphicon-plus"></i>@lang('textile.add_color_row')
                                                    </a>
                                                    <input class=" form-control jscolor" id="color" value="ab2567"/>
                                                </div>
                                                <table class="table table-bordered" id="tbl_colors">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('textile.color')</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbl_colors_body">

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            {!! Form::label(__('textile.images'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-4">
                                                <div class="well clearfix">
                                                    <a class="btn btn-primary pull-right add_image_row" data-added="0">
                                                        <i class="glyphicon glyphicon-plus"></i>@lang('textile.add_image_row')
                                                    </a>
                                                </div>
                                                <table class="table table-bordered" id="tbl_images">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('textile.image')</th>
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
                                            <div class="col-sm-4 col-sm-offset-2">
                                                {!! Form::submit(__('message.save'), ['class' => 'btn btn-primary']) !!}
                                                {!! Form::reset( __('message.reset')  , ['class' => 'btn btn-white']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            {!! Form::label(__('textile.seo_title'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-6">
                                                {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.seo_description'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::textarea('seo_description', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            {!! Form::label(__('textile.description'),null,['class' => 'col-sm-2 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                    </div>
                                </div>


                                {!! Form::close() !!}

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="display:none;">
        <table id="sample_color_table">
            <tr id="">
                <td><span class="sn"></span>.</td>
                <td>{!! Form::text('color_codes[]', null, ['class' => 'form-control jscolor color_code','id'=>'color_code','data-id'=>'0']) !!}</td>
                <td><a class="btn btn-xs delete_color_row" data-id="0"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        </table>

        <table id="sample_image_table">
            <tr id="">
                <td><span class="sn"></span>.</td>
                <td>
                    {!! Form::file('images[]', null, ['class' => 'form-control image','id'=>'image','data-id'=>'0']) !!}
                    <input type="hidden" value="" name="old_images[]" class="old_image">
                </td>
                <td><img src="" id="current_image" class="current_image form-control"/></td>
                <td><a class="btn btn-xs delete_image_row" data-id="0"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        </table>
    </div>

    <script type="text/javascript" src="{{ backendTheme('js/plugins/chosen/chosen.jquery.js') }}"></script>
    <script type="text/javascript" src="{{ backendTheme('js/plugins/chosen/ajax-chosen.js') }}"></script>
    <script type="text/javascript" src="{{ backendTheme('js/plugins/persian-datepicker/persian-date.js') }}"></script>
    <script type="text/javascript"
            src="{{ backendTheme('js/plugins/persian-datepicker/persian-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ backendTheme('js/textile.js') }}"></script>

    @foreach( $textile->colors as $color)
        <script>
            var id = jQuery('#tbl_colors_body >tr').length + 1;
            editColorRecord(id, '{{ $color->color_code }}');
        </script>
    @endforeach

    @foreach( $textile->images as $image)
        <script>
            var id = jQuery('#tbl_images_body >tr').length + 1;
            editImageRecord(id, '{{ $image->image }}', '{{ $image->image }}');
        </script>
    @endforeach

    <script>
        jQuery(document).delegate('a.add_color_row', 'click', function (e) {
            e.preventDefault();
            addColorRecord(jQuery('#tbl_colors >tbody >tr').length + 1);
        });
        jQuery(document).delegate('a.delete_color_row', 'click', function (e) {
            e.preventDefault();
            deleteColorRecord(jQuery(this), '{{ __('message.are_you_sure') }}')
        });

        jQuery(document).delegate('a.add_image_row', 'click', function (e) {
            e.preventDefault();
            addImageRecord(jQuery('#tbl_images >tbody >tr').length + 1);
        });
        jQuery(document).delegate('a.delete_image_row', 'click', function (e) {
            e.preventDefault();
            deleteImageRecord(jQuery(this), '{{ __('message.are_you_sure') }}')
        });

        function preaper_price_pattern(id) {
            var url = '{{ route("backend.pricepatterns.get", ":id") }}';
            url = url.replace(':id', id);
          //  $('#price').val()
            getPricePattern(url, '{{ csrf_token() }}', $('#price').val(),'{{ !empty($textile) ? $textile->id : 0 }}');
        }

        preaper_price_pattern($('#price_pattern_id').val());

        $('#price_pattern_id').on('change', function (e) {
            preaper_price_pattern(this.value);
        });

    </script>

@endsection



