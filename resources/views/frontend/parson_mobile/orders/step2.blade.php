@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('order.step2'))
@section('back_url',route('order.step1'))
@php
    $has_basket = true;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <div class="order-process-navbox">
                <div class="process-nav-bar">
                    <div class="process-item success"></div>
                    <div class="process-item success"></div>
                    <div class="process-item"></div>
                </div>
                <div class="process-nav-item process-nav-pass">
                    <span class="icon icon-fast-delivery left"></span>
                </div>
                <div class="process-nav-item">
                    <span class="icon icon-credit-pass"></span>
                </div>
                <div class="process-nav-item">
                    <span class="icon icon-check-mark"></span>
                </div>
            </div>
            <h3 class="order-summary-title">خلاصه سفارش</h3>
            @foreach($Basket_Info as $basket)
                <div class="order-summary-box">
                    <div class="order-summary-row">
                        <div class="summary-label">
                            <span class="label-title">کد محصول:</span>
                            <span class="label-text en">{{ $basket['textile_id'] }}</span>
                        </div>
                        <div class="summary-label">
                            <span class="label-title"> رنگ:</span>
                            <span class="label-color" style="background: {{ $basket['color'] }}"></span>
                        </div>

                    </div>
                    <div class="order-summary-row">
                        <div class="summary-label">
                            <span class="label-title">اندازه:</span>
                            <span class="label-text">{{ $basket['requested_size'] }}
                                @if ($basket['unit_measurement']=='METER')
                                    متر
                                @else
                                    يارد
                                @endif
                            </span>
                        </div>
                        <div class="summary-label">
                            <span class="label-title">قیمت:</span>
                            <span class="label-text">{{ number_format($basket['sum_price_discount']) }} ریال</span>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="summary-basket-main">
                <div class="summary-basket-header">
                    <h3 class="summary-basket-title">خلاصه سبد</h3>
                    <span class="basket-num">{{ count($Basket_Info) }} کالا</span>
                </div>
                <div class="summary-price-box">
                    <div class="summary-price-row">
                        <span class="summary-price-title">قیمت کالا ها:</span>
                        <span class="summary-price-text">{{ number_format($sum_price) }} ریال</span>
                    </div>
                    <div class="summary-price-row">
                        <span class="summary-price-title">جمع کل: </span>
                        <span class="summary-price-text">{{ number_format($sum_price_discount) }} ریال</span>
                    </div>
                </div>
                <div class="user-detail-box">
                    <div class="user-detail-row">
                        <span class="user-label-title">نام گیرنده:</span>
                        <span class="user-label-text">{{ $userDetail->recipient_name }}</span>
                    </div>
                    <div class="user-detail-row">
                        <span class="user-label-title">آدرس:</span>
                        <span class="user-label-text"> {{ $userDetail->address }}</span>
                    </div>
                </div>
                <!-- <div class="pr-detail-box"></div>
                <div class="pr-detail-box column-5"></div> -->
            </div>
            <div class="form-group-box justify-content-center">
                {!! Form::model(null, ['route' => ['order.save'] ,'method' => 'post'] ) !!}
                    <button class="submit-btn" type="submit">ثبت و ادامه فرایند</button>
                {!! Form::close() !!}
            </div>
        </div>
    </main>
    <script src="{{ frontendTheme('js/order-proses.js') }}"></script>
@endsection
