@extends('layouts.auth')
@section('title',__('user.login_to_admin'))
@section('heading',__('user.welcome_to_admin'))
@section('content')
    {!! Form::open() !!}

    <div class="form-group">
        {!! Form::text('email',null,['class'=>'form-control','placeholder'=>__('user.email')]) !!}
    </div>

    <div class="form-group">
        {!! Form::password('password', ['class' => 'form-control','placeholder'=>__('user.password')]) !!}
    </div>

    {!! Form::submit(__('user.login'),['class'=>'btn btn-primary block full-width m-b']); !!}
    {!! Form::close() !!}
@endsection
