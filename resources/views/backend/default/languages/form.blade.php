@extends('layouts.default')
@section('title',$language->exists ? __('language.edit').' '.$language->name : __('language.add'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$language->exists ? __('language.edit').' '.$language->name : __('language.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($language, [
                            'route' => $language->exists ? ['backend.languages.update', $language->id] : ['backend.languages.store'],
                            'method' => $language->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('language.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('language.native_title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('native_title', null, ['class' => 'form-control']) !!}
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
                            {!! Form::label(__('language.state'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-2">
                                {!! Form::select('state',[
                                    '1'=>__('message.active'),
                                    '0' =>__('message.deactive'),
                                ], $language->state, ['class' => 'form-control']) !!}
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



@endsection



