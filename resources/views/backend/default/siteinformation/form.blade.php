@extends('layouts.default')
@section('title', __('siteinformation.edit'))

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{$siteinformation->exists ? __('siteinformation.edit').' '.$siteinformation->name : __('siteinformation.add')}}
                            <small></small></h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($siteinformation, [
                            'route' => ['backend.siteinformations.update'],
                            'method' => $siteinformation->exists ? 'put' : 'post','class' => 'form-horizontal'] ) !!}

                        <div class="form-group">
                            {!! Form::label(__('siteinformation.title'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('siteinformation.keywords'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('keywords', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <span>@lang('siteinformation.seprate_with_virgol')</span>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('siteinformation.description'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('description', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('Instagram'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('instagram', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            {!! Form::label(__('Facebook'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="hr-line-dashed"></div><div class="form-group">
                            {!! Form::label(__('Twitter'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="hr-line-dashed"></div><div class="form-group">
                            {!! Form::label(__('Telegram'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('telegram', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="hr-line-dashed"></div><div class="form-group">
                            {!! Form::label(__('Worldwide'),null,['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('worldwide', null, ['class' => 'form-control']) !!}
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



