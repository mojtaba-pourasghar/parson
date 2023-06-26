@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('trend.trends'))
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <!-- start single trend cover photo   -->
            <div class="image-covertrend-box">
                <a href="#" class="covertrend-box">
                    <img src="{{ $trend->thumbnail }} " alt="{{ $trend->title }}">
                </a>
            </div>
            <!-- end single trend cover photo   -->

            <!-- start color palet   -->
            <div class="trend-palet-box">
                @foreach($trend->colors as $color)
                    <a href="{{ route('textile.search').'?color='.str_replace('#','',$color->color_code) }}" class="color-box"
                       style="background: {{ $color->color_code }};"></a>
                @endforeach
            </div>
            <!-- end color palet   -->
            <!--<div class="trend-column-section">
                <div class="trend-column-6">
                    <div class="trend-column-box">
                        <img src="static/images/trend-wshirt.PNG" alt="">
                    </div>
                </div>
                <div class="trend-column-6">
                    <div class="trend-column-box">
                        <img src="static/images/trend-wshirt.PNG" alt="">
                    </div>
                </div>
            </div>-->
            <!-- start single-trend comments -->
            <div class="trend-description-section">
                <div class="trend-description-box">
                    <h3 class="description-title">{{ $trend->title }}</h3>
                </div>
                {!! $trend->present()->bodyHtml  !!}
            </div>
            <!-- end single-trend comments -->
            <div class="single-trend-prsec">
                @foreach($trend->textiles as $textile)
                    <div class="trend-product-box">
                        <div class="product-right-column">
                            <a href="{{ getTextileLink($textile->id,$textile->slug) }}" class="product-thumbnail">
                                <img src="{{ (count($textile->images)>0) ? $textile->images[0]->image : ''}}" alt="{{ $textile->title }}">
                            </a>
                            <div class="product-detail-box">
                                <h3 class="product-title">
                                    <a href="{{ getTextileLink($textile->id,$textile->slug) }}">{{ $textile->title }}</a>
                                </h3>
                                <span class="product-condition">
                                    @if($textile->available_amount < 5 && $textile->available_amount > 1)
                                        @if($textile->unit_measurement=='YARD')
                                            {{$textile->available_amount}} یارد موجود در انبار
                                        @else
                                            {{$textile->available_amount}} متر موجود در انبار
                                        @endif

                                    @elseif ($textile->available_amount > 5)

                                    @else
                                        در انبار موجود نیست
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="product-left-column">
                            <div class="product-price-box">
                                <span class="product-price-base">هر @if($textile->unit_measurement=='YARD')
                                        یارد
                                    @else
                                        متر
                                    @endif</span>
                                <span class="product-price">
                                     {{number_format($textile->sum_price_with_off)}} ریال
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    <script src="{{ frontendTheme('js/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ frontendTheme('js/last.js') }}"></script>
@endsection
