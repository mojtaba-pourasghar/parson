@extends('layouts.getway')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('order.step3'))
@section('back_url',route('order.step1'))
@section('manual_back',1)
@php
    $has_basket = false;
    $manual_back = true;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <div class="order-process-navbox">
                <div class="process-nav-bar">
                    <div class="process-item success"></div>
                    <div class="process-item success"></div>
                    <div class="process-item success"></div>
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
            <div class="order-pr-main">
                @if (!empty($ReferenceId))
                    <h2 class="order-success-title">فرایند ثبت سفارش تکمیل گردید</h2>
                    <div class="order-pr-factor">
                        کاربر گرامی
                        <br>
                        سفارشتان ثبت شد و در حال پردازش آن هستیم.
                        <br>
                        شما میتوانید وضعیت سفارش خود را در بخش پیگیری سفارشات دنبال کنید.
                        <br>
                        شماره سفارش: {{ $ordercode }}
                        <br>
                        شماره پيگيري: {{ $ReferenceId }}
                    </div>
                @else
                    <h2 class="order-error-title">فرایند ثبت سفارش با خطا مواجه شد</h2>
                    <div class="order-pr-factor">
                        کاربر گرامی
                        <br>
                        لطفا وارد سبد خرید خود شوید و دوباره تلاش نمایید
                    </div>
                @endif

            </div>
        </div>
    </main>
    <script src="{{ frontendTheme('js/order-proses.js') }}"></script>
@endsection
