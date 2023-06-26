@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('header_title','ورود')
@section('back_url',route('home'))
@php
    $has_basket = false;
@endphp
@section('content')

    <main>
        <div class="gray-box">
            <div class="default-full-container gray-container">
                <div class="parson-pic-box">
                    <img src="{{ frontendTheme('images/ic_luncher.png') }}" alt="" class="parson-pic">
                </div>
                <div class="main-form-box">
                    {!! Form::model(null, ['route' =>['login'] ,'method' => 'post' ,'class' => 'main-form'] ) !!}
                    @include('partials.flash-message')
                    <div class="form-group-box">
                        <div class="form-message-text">شماره موبایل خود را وارد نمایید</div>
                    </div>
                    <div class="form-group-box confrim-input-box">
                        <input type="text" name="mobile" class="input-control" maxlength="11"
                               placeholder="شماره موبايل">
                    </div>
                    <div class="form-group-box confrim-input-box">
                        <input type="password" name="password" class="input-control" placeholder="رمز عبور">
                    </div>
                    <div class="form-group-box justify-content-center">
                        <button class="submit-btn" type="submit">ورود</button>
                    </div>
                    <div class="form-group-box justify-content-center">
                        <a href="{{ route('register') }}" class="singup-link">آیا ثبت نام نکرده اید؟</a>
                    </div>
                    <div class="form-group-box justify-content-center">
                        <a href="{{ route('user.send_password') }}" class="singup-link">فراموشي رمز عبور</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </main>
    <script src="{{ frontendTheme('js/confrim.js') }}"></script>
@endsection
