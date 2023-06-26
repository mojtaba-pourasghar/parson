@extends('layouts.default')
@section('title',$category->exists ? __('category.edit').' '.$category->name : __('category.add'))

@section('content')
    <script type="text/javascript" src="{{ backendTheme('js/ckeditor/ckeditor.js') }}"></script>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$category->exists ? __('category.edit').' '.$category->name : __('category.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($category, [
                            'route' => $category->exists ? ['backend.categories.update', $category->id] : ['backend.categories.store'],
                            'method' => $category->exists ? 'put' : 'post','class' => 'form-horizontal','files'=>'true'] ) !!}
                        <div class="form-group">
                            {!! Form::label(__('category.category'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('parent_id',[''=>''] + $orderList, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('category.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('role.slug'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('slug', null, ['class' => 'form-control','style'=>'direction:ltr']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('category.seo_title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('category.seo_description'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('seo_description', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('category.description'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('description', null, ['class' => 'form-control','id'=>'description']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('category.thumbnail'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                <img id="thumbnail" src="{{ '/'.$path.'/'.$category['thumbnail'] }}"
                                     alt="{{ __('category.selected_image') }}" width="100" height="100"/>
                                <input type="file" name="thumbnail_file"
                                       onchange="document.getElementById('thumbnail').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('category.order'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::number('order', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('category.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive')
                                ], $category->state, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('message.status'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('status',[
                                    'WITH_OUT_INFORMATION' =>__('message.with_out_information'),
                                    'WITH_OUT_TEXT' =>__('message.with_out_text'),
                                    'FIRST_INFORMATION' =>__('message.first_information'),
                                    'EDITED' =>__('message.edited'),
                                    'SEO' =>__('message.seo'),
                                    'FINAL' =>__('message.final'),
                                    'CONTENT_PRODUCTION' =>__('message.content_production'),
                                     'OTHER' =>__('message.other'),
                                ], $category->status, ['class' => 'form-control']) !!}
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


    <script>
        CKEDITOR.replace('description');
    </script>
@endsection



