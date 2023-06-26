@extends('layouts.activity')
@section('title',__('user.mobile_verify'))
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>__('user.mobile_verify'),'description'=>'','image'=>''])
@endsection
@section('header_title',__('user.mobile_verify'))
@section('back_url',route('register'))
@php
    $has_basket = false;
@endphp
@section('content')

    <main>
        <div class="gray-box">
            <div class="default-full-container gray-container">
                <div class="parson-pic-box">
                    <img src="static/images/ic_luncher.png" alt="" class="parson-pic">
                </div>
                <div class="main-form-box">
                        {!! Form::model(null, ['route' =>['user.mobile_verify', $mobile] ,'method' => 'put' ,'class' => 'main-form','files'=>'true'] ) !!}
                        <div class="form-group-box">
                            <div class="form-message-text">کد تایید را وارد نمایید</div>
                        </div>
                        <div class="form-group-box confrim-input-box">
                            <input type="text" class="input-control" name="mobile_confirmation" maxlength="5">
                        </div>
                        <!--<div class="active-time-box">
                            <span id="timer">1:00</span>
                            <a href="#" class="re-confrim-code">دریافت مجدد کد تایید</a>
                        </div>-->

                        <div class="form-group-box justify-content-center">
                            <button class="submit-btn" type="submit">فعال سازي</button>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </main>

    <script src="{{ frontendTheme('js/confrim.js') }}"></script>
@endsection
