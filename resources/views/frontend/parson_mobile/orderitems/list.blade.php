@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('order.orderitems'))
@section('back_url',route('order.list'))
@php
    $has_basket = false;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <div class="pr-main-detail-box">
                <div class="pr-dtBox-row">
                    <div class="pr-dtBox-col column-6">
                        <span class="pr-dtBox-title">کد:</span>
                        <span class="pr-dtBox-name en">{{ $order->code }}</span>
                    </div>
                    <div class="pr-dtBox-col column-6">
                        <span class="pr-dtBox-title">تاریخ سفارش:</span>
                        <span class="pr-dtBox-name">{{ $order->created_at }}</span>
                    </div>
                </div>
                <div class="pr-dtBox-row">
                    <div class="pr-dtBox-col column-6">
                        <span class="pr-dtBox-title">گیرنده:</span>
                        <span class="pr-dtBox-name">{{ $order->user_detail->recipient_name }}</span>
                    </div>
                    <div class="pr-dtBox-col column-6">
                        <span class="pr-dtBox-title"> شماره موبایل:</span>
                        <span class="pr-dtBox-name">{{ $order->user_detail->telephon }}</span>
                    </div>
                </div>
                <div class="pr-dtBox-row">

                    <div class="pr-dtBox-col column-12">
                        <span class="pr-dtBox-title">ارسال به:</span>
                        <span class="pr-dtBox-name">{{ $order->user_detail->address }}</span>
                    </div>
                </div>
                <div class="pr-dtBox-row">
                    <div class="pr-dtBox-col column-12">
                        <span class="pr-dtBox-title"> مبلغ کل:</span>
                        <span class="pr-dtBox-name"> {{ number_format($order->sum_price) }} ریال</span>
                    </div>
                </div>
            </div>
            <div class="order-main-dtBox">
                <div class="order-panel">
                    <div class="order-send-detail">
                        <div class="order-send-col column-6">
                            <div class="order-receive-box">تحویل محصول به مشتری</div>
                        </div>
                        <div class="order-send-col column-6">
                            <span class="order-send-title">تاریخ تحویل:</span>
                            <span class="order-send-name">----</span>
                        </div>
                    </div>
                    <div class="order-send-detail">
                        <div class="order-send-col column-6">
                            <span class="order-send-title">قیمت محصول:</span>
                            <span class="order-send-name">{{ number_format($order->sum_price) }} ریال</span>
                        </div>
                        <div class="order-send-col column-6">
                            <span class="order-send-title">هزینه ارسال:</span>
                            <span class="order-send-name">0</span>
                        </div>
                    </div>
                </div>

                @foreach($orderItems as $orderItem)
                    <div class="order-panel">
                        <div class="product-image-box">
                            <a href="{{ getTextileLink($orderItem->textile->id,$orderItem->textile->slug) }}" class="img-box">
                                <img src="{{ (count($orderItem->textile->images)>0) ? $orderItem->textile->images[0]->image : ''}}" alt="{{ $orderItem->textile->title }}">
                            </a>
                        </div>
                        <div class="product-detail-content">
                            <h3 class="detail-content">{{ $orderItem->textile->title }}</h3>
                            <h3 class="detail-content">کد محصول: {{ $orderItem->textile->barcode }}</h3>
                            <h3 class="detail-content">{{ $orderItem->item_count }} متر</h3>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </main>
@endsection
