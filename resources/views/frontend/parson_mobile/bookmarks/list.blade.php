@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('bookmark.list'))
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')

    <main>
        <div class="default-full-container">
            <div class="search-result-main">



                <div class="search-result-box">
                    @foreach($bookmarks as   $bookmark)
                        <div class="product-result-box">
                        <div class="product-result-col result-col-detail column-6">
                            <a class="shoping-thumb-box" href="{{ getTextileLink($bookmark->textile->id,$bookmark->textile->slug) }}">
                                <img src="{{ (count($bookmark->textile->images)>0) ? $bookmark->textile->images[0]->image : ''}}" alt="{{ $bookmark->textile->title }}">
                            </a>
                            <div class="shoping-detail-box">
                                <div class="shoping-title-box">
                                    <h2 class="shoping-title">{{ $bookmark->textile->title }}</h2>
                                </div>
                                <!--<div class="product-type">
                                    <span class="type-icon">
                                        <i class="icon icon-original"></i>
                                    </span>
                                        اصلی
                                </div>-->


                            </div>
                        </div>
                        <!--<div class="product-result-col result-col-price column-6">
                            <div class="shoping-price-box">

                                <div class="shoping-price-row">
                                    <span class="price-title">هر متر</span>
                                    <span class="primary-price"> / 100,000 هزار تومان</span>
                                </div>
                            </div>
                        </div>-->
                        <div class="order-link-box">

                            <a href="{{ route('bookmark.delete',$bookmark->id) }}" class="delete-box">
                                <span class="delete-icon-box">
                                    <i class="icon icon-bin"></i>
                                </span>
                                حذف کالا
                            </a>

                            <a href="{{ getTextileLink($bookmark->textile->id,$bookmark->textile->slug) }}" class="shop-link">مشاهده و خرید کالا

                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
