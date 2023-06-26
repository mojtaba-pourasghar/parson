@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('basket.basket'))
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <div class="shoping-address-box">
                <h2 class="address-title">
                    ارسال به
                </h2>
                <div class="address-main-box">
                    <h3 class="address-main-text">
                        <span class="address-icon-box">
                            <i class="icon icon-location"></i>
                        </span>
                        {{ $userDetail->address }}
                    </h3>
                    <a href="{{ route('userdetail.addresses') }}" class="address-btn-icon">
                        <i class="fal fa-angle-left"></i>
                    </a>
                </div>
            </div>
            <div class="shop-order-main">
                <div class="shop-order-heading">
                    <h2 class="order-title">
                        <span class="shop-icon">
                            <i class="icon icon-shopping-cart"></i>
                        </span>
                        سبد خرید
                    </h2>
                    <h2 class="order-num">{{ (!empty($Basket_Info)) ? count($Basket_Info) : "0" }} کالا</h2>
                </div>
                @php
                    $sum_price_discount = 0;
                    $sum_price = 0;
                @endphp
                @if(!empty($Basket_Info))
                    @foreach($Basket_Info as $item)
                        <div class="pr-order-box">
                            <div class="order-detail-main">
                                <div class="order-img-box">
                                    <a
                                        href="{{ getTextileLink($item['textile_id'],$item['slug']) }}"><img
                                            src="{{ $item['image'] }}" alt=""></a>
                                </div>

                                <div class="order-detail-content">
                                    <div class="product-type">
                                        @if ($item['type'] == 'MAIN')
                                            <span class="type-icon">
                                               <i class="icon icon-original"></i>
                                           </span>
                                            اصلي
                                        @else
                                            <span class="type-icon">
                                                <i class="icon icon-sample"></i>
                                            </span>
                                            نمونه
                                        @endif
                                    </div>
                                    @if ($item['type'] == 'MAIN')
                                        <h3 class="product-size">{{ $item['requested_size'] }}
                                            @if ($item['unit_measurement']=='METER')
                                                متر
                                            @else
                                                يارد
                                            @endif
                                        </h3>
                                    @endif
                                    <div class="product-color-box">
                                        <span class="color-title">رنگ:</span>
                                        <span class="color-text"> </span>
                                        <span class="color" style="background: {{ $item['color'] }};"></span>
                                    </div>
                                    @if ($item['type'] == 'MAIN')
                                        @if ($item['sum_price']!=0)
                                            <div class="product-price-box">
                                            <span
                                                class="pr-price">{{ number_format($item['sum_price_discount']) }}</span>
                                                <span class="pr-price-title">ریال</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @php
                            $sum_price_discount += $item['sum_price_discount'];
                            $sum_price += $item['sum_price'];
                        @endphp
                        <!--<div class="important-description-box">
                                <h3 class="important-description">
                                    <span class="info-box"><i class="icon icon-info"></i></span>
                                    در هر سفارش برای هر پارچه فقط یکبار امکان دریافت نمونه وجود دارد.
                                </h3>
                                <h3 class="important-description">
                                    <span class="info-box"><i class="icon icon-info"></i></span>
                                    به ازای هر 5 عدد نمونه پارچه مبلغ 15،000 ریال هزینه دریافت می گردد.
                                </h3>

                            </div>-->
                            <div class="trash-icon-box">
                                <a href="{{ route('basket.delete',$item['textile_id']) }}"
                                   class="delete-box">
                                    <span class="icon icon-bin"></span>
                                </a>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
            <div class="order-summary-main">
                <div class="shop-order-heading">
                    <h2 class="order-title">
                        <span class="shop-icon">
                            <i class="icon icon-shopping-cart"></i>
                        </span>
                        خلاصه سبد
                    </h2>
                    <h2 class="order-num">{{ (!empty($Basket_Info)) ? count($Basket_Info) : "0" }} کالا</h2>
                </div>
                <div class="order-summary-content">
                    <div class="summary-content-row">
                        <h3 class="order-title">قیمت کالاها</h3>
                        <h3 class="order-price">
                            <span class="price">{{ number_format($sum_price) }}</span>
                            <span class="price-title">ریال</span>
                        </h3>
                    </div>
                    <div class="summary-content-row">
                        <h3 class="order-title">تخفیف</h3>
                        <h3 class="order-price red">
                            <span class="price">{{ number_format($sum_price - $sum_price_discount) }}</span>
                            <span class="price-title">ریال</span>
                        </h3>
                    </div>

                    <div class="summary-content-row">
                        <h3 class="order-title">جمع کل</h3>
                        <h3 class="order-price">
                            <span class="price">{{ number_format($sum_price_discount) }}</span>
                            <span class="price-title">ریال</span>
                        </h3>
                    </div>
                </div>
                <div class="order-summary-content">
                    <!--<div class="summary-content-row">
                        <h3 class="order-title">
                            <div class="corn-icon-box">
                                <span class="icon-corn">
                                    <span class="path1"></span><span class="path2"></span><span
                                        class="path3"></span><span class="path4"></span><span class="path5"></span><span
                                        class="path6"></span><span class="path7"></span><span class="path8"></span><span
                                        class="path9"></span>
                                </span>

                            </div>
                            امتیاز کیف پول پرسون
                        </h3>
                        <h3 class="order-price">
                            <span class="price">150</span>
                            <span class="price-title">امتیاز</span>
                        </h3>
                    </div>-->
                    <div class="summary-content-row">
                        <div class="buy-box">
                            <a href="{{ route('order.step1') }}" class="buy-btn">تکمیل فرآیند خرید</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
