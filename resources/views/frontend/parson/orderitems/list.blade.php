@extends('layouts.frontend')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('content')
    <main>
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title">
                        <a href="{{ route('home') }}">@lang('message.home')
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">@lang('order.orderitems')</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->

                <div class="profile-main">
                    @include(currentFrontView('partials.users.edit_profile_right_menu'),['active'=>'orders'])
                    <div class="profile-main-content column-7">
                        <div class="profile-content-box">
                            <div class="order-pr-dtBox">
                                <div class="pr-headerBox">
                                    <a href="{{ route('order.list') }}" class="pr-ar-icon">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <a href="#" class="pr-title">جزئیات سفارش</a>
                                    <span class="pr-title-box">{{ $order->created_at }}</span>
                                    <span class="pr-title-box">{{ $order->code }}</span>
                                </div>
                                <div class="pr-main-dtBox">
                                    <div class="pr-dtBox-row">
                                        <div class="pr-dtBox-col column-6">
                                            <span class="pr-dtBox-title">گیرنده:</span>
                                            <span class="pr-dtBox-name">{{ $order->user_detail->recipient_name }}</span>
                                        </div>
                                        <div class="pr-dtBox-col column-6">
                                            <span class="pr-dtBox-title">شماره موبایل:</span>
                                            <span class="pr-dtBox-name">{{ $order->user_detail->telephon }}</span>
                                        </div>
                                        <div class="pr-dtBox-col column-12">
                                            <span class="pr-dtBox-title">ارسال به:</span>
                                            <span class="pr-dtBox-name">{{ $order->user_detail->address }}</span>
                                        </div>
                                    </div>

                                    <div class="pr-dtBox-row">
                                        <div class="pr-dtBox-col column-12">
                                            <span class="pr-dtBox-title"> مبلغ کل:</span>
                                            <span class="pr-dtBox-name">
                                                {{ number_format($order->sum_price) }} ریال
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-pr-mdtBox">
                                <div class="order-panel">
                                    <div class="order-send-detail">
                                        <div class="order-send-col column6">
                                            <span class="order-send-title">تحویل:</span>
                                            <span class="order-send-name">----</span>
                                        </div>
                                        <div class="order-send-col column6">
                                            <div class="order-receive-box">
                                                تحویل محصول به مشتری
                                                <div class="receive-line-box"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-send-detail">
                                        <div class="order-send-col column6">
                                            <span class="order-send-title">قیمت محصول:</span>
                                            <span class="order-send-name"> {{ number_format($order->sum_price) }} ریال</span>
                                        </div>
                                        <div class="order-send-col column6">
                                            <span class="order-send-title">هزینه ارسال:</span>
                                            <span class="order-send-name">0 </span>
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

                    </div>
                </div>

                <!-- end profile main  -->
                <!-- start subscript  -->
            @include(currentFrontView('partials.subscription'))
            <!-- end subscript  -->
            </div>

        </section>
    </main>
@endsection
