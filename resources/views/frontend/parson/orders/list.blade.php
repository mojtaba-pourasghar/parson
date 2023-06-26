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
                        <a href="#">@lang('order.list')</a>

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
                                    <a href="#" class="pr-title">@lang('order.list')</a>
                                </div>
                            </div>
                            <div class="order-list-heading list-green-heading">
                                <h3 class="order-heading-title">
                                    <span class="order-list-icon"> <i class="icon icon-list"></i></span>
                                </h3>
                                <h3 class="order-heading-title">شماره سفارش</h3>
                                <h3 class="order-heading-title">تاریخ ثبت سفارش</h3>
                                <h3 class="order-heading-title">مبلغ کل</h3>
                                <h3 class="order-heading-title">عملیات پرداخت</h3>
                                <h3 class="order-heading-title">جزئیات</h3>
                            </div>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach($orders as $order)
                                <div class="order-list-row">
                                    <h3 class="order-list-item">{{ $counter }}</h3>
                                    <h3 class="order-list-item">{{ $order->code }}</h3>
                                    <h3 class="order-list-item">
                                    {{ $order->created_at }}
                                     </h3>
                                    <h3 class="order-list-item">{{ number_format($order->sum_price) }} ریال</h3>

                                        @switch($order->transaction_pay->status)
                                            @case(0)
                                                <h3 class="order-list-item yellow">در انتظار پرداخت</h3>
                                            @break
                                            @case(1)
                                                <h3 class="order-list-item green">پرداخت موفق</h3>
                                            @break
                                            @case(2)
                                            <h3 class="order-list-item red">لغو شده</h3>
                                            @break
                                        @endswitch

                                    <h3 class="order-list-item">
                                     <span class="arrow-icon">
                                        <a href="{{ route('orderitems.list',$order->id) }}"><i class="fal fa-angle-left"></i></a>
                                     </span>
                                    </h3>
                                </div>
                                @php
                                    $counter ++;
                                @endphp
                            @endforeach

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
