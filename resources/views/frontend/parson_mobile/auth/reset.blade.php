@extends('layouts.auth')
@section('title','Reset Password')

@section('content')
    {!! Form::open() !!}
    @csrf
    <div class="form-group">
        {!! Form::label('email') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password') !!}
        {!! Form::password('password',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation') !!}
        {!! Form::password('password_confirmation',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::submit('Reset password',['class'=>'btn btn-primary']); !!}

    {!! Form::close() !!}
@endsection
