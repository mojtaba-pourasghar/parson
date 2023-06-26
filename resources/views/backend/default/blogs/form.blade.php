@extends('layouts.default')
@section('title',$blog->exists ? __('blog.edit').' '.$blog->name : __('blog.add'))

@section('content')
    <script type="text/javascript" src="{{ backendTheme('js/ckeditor415/ckeditor.js') }}"></script>


    <link href="{{ backendTheme('css/plugins/persian-datepicker/persian-datepicker.min.css') }}" rel="stylesheet">

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$blog->exists ? __('blog.edit').' '.$blog->name : __('blog.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($blog, [
                            'route' => $blog->exists ? ['backend.blogs.update', $blog->id] : ['backend.blogs.store'],
                            'method' => $blog->exists ? 'put' : 'person','class' => 'form-horizontal','files'=>'true'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('blog.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.slug'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('slug', null, ['class' => 'form-control','style'=>'direction:ltr']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.seo_title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.seo_description'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('seo_description', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.tag'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::select('tag_ids[]',$blogtags , $selected_blogtags, ['data-placeholder'=>__('blog.please_enter_blogtag'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'tag_id','multiple'=>'multiple']) !!}
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.thumbnail'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                <img id="thumbnail" src="{{ $blog['thumbnail'] }}"
                                     alt="{{ __('blog.selected_image') }}" width="100" height="100"/>
                                <input type="file" name="thumbnail_file"
                                       onchange="document.getElementById('thumbnail').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.uri'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('uri', null, ['class' => 'form-control','style'=>'direction:ltr','placeholder'=>'https://']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.excerpt'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.description'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'description']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.published_at'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('published_at', $blog->PDate, ['class' => 'form-control','id'=>'published_at']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.study_time'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-1">
                                {!! Form::text('study_time', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::label(__('blog.minute'),null,['class' => 'col-sm-1 control-label']) !!}
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('blog.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $blog->state, ['class' => 'form-control']) !!}
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


    <script type="text/javascript" src="{{ backendTheme('js/plugins/persian-datepicker/persian-date.js') }}"></script>
    <script type="text/javascript"
            src="{{ backendTheme('js/plugins/persian-datepicker/persian-datepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ backendTheme('js/blog.js') }}"></script>

@endsection



