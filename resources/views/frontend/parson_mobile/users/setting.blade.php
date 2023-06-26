@extends('layouts.single')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title','اطلاعات شخصی')
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')

    <main>

        <div class="tool-box-top">
            <!--<a href="#" class="pr-img-link pr-share"><i class="icon icon-share"></i></a>-->


            <h2 class="header-title" style="margin-right: 15px">
                <a class="header-link" href="{{ route("basket.list") }}">
                    <span class="header-icon">
                        <i class="icon icon-shopping-cart"></i>
                        <span class="number-basket header_basket" id="header_basket">0</span>
                    </span>
                </a>

            </h2>
        <!--<a href="{{ route('home') }}" class="tool-box-back">-->
            <a class="tool-box-back" href="javascript:void(0)" onclick="history.back()">
                <i class="fal fa-angle-left"></i>
            </a>
        </div>

        <div class="setting-header-box">
            <a class="setting-logo" href="#">
                <img src="{{ frontendTheme('images/ic_luncher.png')}}" alt="">
            </a>
        </div>
        <div class="default-full-container">
            <div class="profile-nav-box">
                <div class="profile-nav-item">
                    <a href="/about" class="profile-nav-link">
                        <span class="link-text">درباره ما</span>

                    </a>
                </div>
                <div class="profile-nav-item">
                    <a href="{{ route('faq.list') }}" class="profile-nav-link">
                        <span class="link-text">@lang('faq.faqs')</span>

                    </a>
                </div>
                <div class="profile-nav-item">
                    <a href="/privacy" class="profile-nav-link">
                        <span class="link-text">حریم خصوصی</span>

                    </a>
                </div>
                <div class="profile-nav-item">
                    <a href="/service" class="profile-nav-link">
                        <span class="link-text">شرایط استفاده</span>

                    </a>
                </div>
                <div class="profile-nav-item">
                    <a href="{{ route('user.change_password') }}" class="profile-nav-link">
                        <span class="link-text">@lang('user.change_password')</span>

                    </a>
                </div>
                <!--<div class="profile-nav-item">
                    <a href="#" class="profile-nav-link">
                        <span class="link-text">معرفی پرسون به دوستان</span>

                    </a>
                </div>-->
            </div>
            <div class="form-group-box justify-content-center">
                <a class="submit-btn" href="{{ route('auth.logout') }}" type="submit">خروج</a>
            </div>
            <div class="social-media-box">
                <div class="social-media-title">به ما بپیوندید</div>
                <div class="social-item-box">
                    <a href="" class="social-item"><img src="{{ frontendTheme('images/telegram.png')}}" alt=""></a>
                    <a href="https://instagram.com/parsontex?igshid=y8s1vleq14ux" target="_blank"
                       class="social-item"><img src="{{ frontendTheme('images/instagram.png')}}" alt=""></a>
                </div>
            </div>
        </div>


    </main>

@endsection
