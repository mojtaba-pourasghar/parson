@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('header_title',__('user.register'))
@section('back_url',route('login'))
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

                    {!! Form::model(null, ['route' =>['register'] ,'method' => 'post' ,'class' => 'main-form'] ) !!}
                    <div class="form-group-box">
                        <div class="form-message-text">
                            @include('partials.flash-message')
                        </div>
                    </div>
                    <div class="form-group-box">
                        <div class="form-message-text">شماره موبایل خود را وارد نمایید</div>
                    </div>
                    <div class="form-group-box confrim-input-box">
                        <input type="text" class="input-control " name="mobile" placeholder="شماره موبايل"
                               maxlength="11">
                    </div>
                    <div class="form-group-box">
                        <input type="password" name="password" class="input-control" placeholder="رمز عبور">
                    </div>
                    <div class="form-group-box">
                        <input type="password" name="password_confirmation" class="input-control"
                               placeholder=" تکرار رمز عبور ">
                    </div>
                    <div class="form-group-box justify-content-center">
                        <button class="submit-btn" type="submit">ارسال کد</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </main>
    <script src="{{ frontendTheme('js/singup.js') }}"></script>

@endsection
