@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('order.list'))
@section('back_url',route('home'))
@php
    $has_basket = true;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <div class="order-list-main">
                @php
                    $counter = 1;
                @endphp
                @foreach($orders as $order)
                    <div class="order-panel-box">
                        <a href="" class="order-img-box">
                            <img src="{{ frontendTheme('images/kerep.jpg') }}" alt="">
                        </a>
                        <div class="order-content-box">
                            <div class="order-box-code">
                                <span class="order-code">{{ $order->code }}</span>
                            </div>
                            <div class="order-content-detail">
                                <h3 class="detail-content">
                                    <span class="detail-title">تاریخ سفارش</span>
                                    <span class="detail">{{ $order->created_at }}</span>
                                </h3>
                                <h3 class="detail-content">
                                    <span class="detail-title">مبلغ کل</span>
                                    <span class="detail">{{ number_format($order->sum_price) }} ریال</span>
                                </h3>
                                <h3 class="detail-content">
                                    <span class="detail-title"> آدرس: </span>
                                    <span class="detail">{{ $order->user_detail->address }}</span>
                                </h3>
                            </div>
                            <div class="order-link-box">
                                <a href="{{ route('orderitems.list',$order->id) }}" class="factor-order-link">مشاهده فاکتور</a>
                                <!--<a href="#" class="shop-again-link">
                                    خرید مجدد
                                    <span class="shop-basket">
                                        <i class="icon icon-shopping-cart"></i>
                                    </span>
                                </a>-->
                            </div>
                        </div>
                    </div>
                    @php
                        $counter ++;
                    @endphp
                @endforeach
            </div>
        </div>
    </main>
@endsection
