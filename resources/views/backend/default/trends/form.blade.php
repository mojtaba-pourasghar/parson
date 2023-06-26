@extends('layouts.default')
@section('title',$trend->exists ? __('trend.edit').' '.$trend->name : __('trend.add'))

@section('content')
    <script type="text/javascript" src="{{ backendTheme('js/ckeditor415/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ backendTheme('js/jscolor.js') }}"></script>

    <link href="{{ backendTheme('css/plugins/persian-datepicker/persian-datepicker.min.css') }}" rel="stylesheet">

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$trend->exists ? __('trend.edit').' '.$trend->name : __('trend.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($trend, [
                            'route' => $trend->exists ? ['backend.trends.update', $trend->id] : ['backend.trends.store'],
                            'method' => $trend->exists ? 'put' : 'person','class' => 'form-horizontal','files'=>'true'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('trend.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.slug'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('slug', null, ['class' => 'form-control','style'=>'direction:ltr']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.sex'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('sex',[
                                    '1'=>__('trend.man'),
                                    '0' =>__('trend.woman'),
                                ], $trend->sex, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.seo_title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.seo_description'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('seo_description', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.tag'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('tag_ids[]',$trend_tags , $selected_trend_tags, ['data-placeholder'=>__('trend.please_enter_trend_tag'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'tag_id','multiple'=>'multiple']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.category'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('category_ids[]',$trend_categories , $selected_trend_categories, ['data-placeholder'=>__('trend.please_enter_trend_category'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'category_id','multiple'=>'multiple']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.textile'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('textile_ids[]',$textiles , $selected_textiles, ['data-placeholder'=>__('trend.please_enter_textile'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'textile_id','multiple'=>'multiple']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.colors'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                <div class="well clearfix">
                                    <a class="btn btn-primary pull-right add_color_row" data-added="0">
                                        <i class="glyphicon glyphicon-plus"></i>@lang('trend.add_color_row')
                                    </a>
                                    <input class=" form-control jscolor" id="color" value="ab2567"/>
                                </div>
                                <table class="table table-bordered" id="tbl_colors">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('trend.color')</th>
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
                            {!! Form::label(__('trend.thumbnail'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                <img id="thumbnail" src="{{ '/'.$path.'/'.$trend['thumbnail'] }}"
                                     alt="{{ __('trend.selected_image') }}" width="100" height="100"/>
                                <input type="file" name="thumbnail_file"
                                       onchange="document.getElementById('thumbnail').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.uri'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('uri', null, ['class' => 'form-control','style'=>'direction:ltr','placeholder'=>'https://']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.excerpt'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.description'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'description']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.published_at'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('published_at', null, ['class' => 'form-control','id'=>'published_at']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.study_time'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-1">
                                {!! Form::text('study_time', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::label(__('trend.minute'),null,['class' => 'col-sm-1 control-label']) !!}
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('trend.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $trend->state, ['class' => 'form-control']) !!}
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
        <table id="sample_color_table">
            <tr id="">
                <td><span class="sn"></span>.</td>
                <td>{!! Form::text('color_codes[]', null, ['class' => 'form-control jscolor color_code','id'=>'color_code','data-id'=>'0']) !!}</td>
                <td><a class="btn btn-xs delete_color_row" data-id="0"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        </table>
    </div>
    <script type="text/javascript" src="{{ backendTheme('js/textile.js') }}"></script>
    @foreach( $trend->colors as $color)
        <script>
            var id = jQuery('#tbl_colors_body >tr').length + 1;
            editColorRecord(id, '{{ $color->color_code }}');
        </script>
    @endforeach
    <script type="text/javascript" src="{{ backendTheme('js/plugins/persian-datepicker/persian-date.js') }}"></script>
    <script type="text/javascript"
            src="{{ backendTheme('js/plugins/persian-datepicker/persian-datepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ backendTheme('js/trend.js') }}"></script>


    <script>
        jQuery(document).delegate('a.add_color_row', 'click', function (e) {
            e.preventDefault();
            addColorRecord(jQuery('#tbl_colors >tbody >tr').length + 1);
        });
        jQuery(document).delegate('a.delete_color_row', 'click', function (e) {
            e.preventDefault();
            deleteColorRecord(jQuery(this), '{{ __('message.are_you_sure') }}')
        });

    </script>

@endsection



