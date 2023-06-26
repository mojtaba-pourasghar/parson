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
                        <a href="#">روش پرداخت</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="order-proses-navbox">
                    <div class="proses-nav-bar"></div>
                    <div class="proses-nav-item proses-nav-pass">
                        <span class="icon icon-fast-delivery left"></span>
                    </div>
                    <div class="proses-nav-item proses-nav-pass">
                        <span class="icon icon-credit-pass"></span>
                    </div>
                    <div class="proses-nav-item">
                        <span class="icon icon-check-mark"></span>
                    </div>
                </div>
                <div class="order-detail-box">
                    <h2 class="detail-main-title">خلاصه سفارش</h2>
                    <div class="detail-box-column9">
                        <div class="summary-order-column5">
                            <div class="summary-order-box">
                                <!--<h3 class="summary-content">کد محصول:
                                    <span class="gray"> A31NJ4</span>
                                </h3>
                                <h3 class="summary-content">اندازه:
                                    <span class="gray">2 متر</span>
                                </h3>-->
                                <h3 class="summary-content">گیرنده:
                                    <span class="gray">
                                     {{ $userDetail->recipient_name }}
                                    </span>
                                </h3>
                                <h3 class="summary-content">شماره تماس:
                                    <span class="gray">{{ $userDetail->telephon }}</span>
                                </h3>
                            </div>
                        </div>
                        <div class="summary-order-column7">
                            <div class="summary-order-box">
                                <h3 class="summary-content">نوع ارسال:
                                    <span class="gray">----</span>
                                </h3>
                                <h3 class="summary-content">زمان تحویل:
                                    <span class="gray">---</span>
                                </h3>


                            </div>
                        </div>
                        <div class="summary-order-column12">
                            <div class="summary-order-box">
                                <h3 class="summary-content">آدرس:
                                    <span class="gray">
                                        {{ $userDetail->address }}
                                    </span>
                                </h3>
                            </div>
                        </div>

                    </div>
                    <div class="detail-box-column3">
                        <div class="product-cost-box">
                            <!--<h3 class="product-cost-content">
                                قیمت محصول:
                                <span class="gray">
                                    <span>255,000</span>
                                تومان
                                </span>
                            </h3>-->
                            <h3 class="product-cost-content">
                                تخفیف:
                                <span class="gray">
                                    <span>{{ number_format($sum_price - $sum_price_discount) }}</span>
                                    ریال
                                </span>
                            </h3>
                            <h3 class="product-cost-content">
                                هزینه ارسال:
                                <span class="gray">
                                <span>0</span>
                                ریال
                             </span>
                            </h3>
                            <h3 class="product-cost-content">
                                جمع صورت حساب:
                                <span class="gray">
                                    <span>{{ number_format($sum_price_discount) }}</span>
                                    ریال
                                 </span>
                            </h3>
                        </div>
                    </div>
                </div>
                <!-- send-product-main  -->
                <div class="send-product-main">
                    @include('partials.flash-message')
                    <div class="select-payment-box">
                        <h3 class="payment-title">شیوه پرداخت</h3>
                    </div>
                    <div class="send-product-nav">
                        <li class="send-tab-item"><a href="#sendPr-1">
                            <span class="send-tab-icon">
                                <i class="icon icon-credit-card"></i>
                            </span>
                                کارت بانکی
                            </a></li>
                        <li class="send-tab-item"><a href="#sendPr-2">
                            <span class="send-tab-icon">
                                <i class="icon icon-wallet"></i>
                            </span>
                                کیف پول
                            </a></li>
                    </div>

                    <div class="product-tab-content" id="sendPr-1">
                        {!! Form::model(null, ['route' => ['order.save'] ,'method' => 'post'] ) !!}
                        <!--<div class="select-card-box">
                                <div class="select-card-item">
                                    <a href="#" class="card-item">
                                        <img src="images/shop/mellat.png" alt="mellat-bank">
                                    </a>
                                </div>
                                <div class="select-card-item">
                                    <a href="#" class="card-item">
                                        <img src="images/shop/parsian.png" alt="parsian-bank">
                                    </a>
                                </div>
                            </div>-->
                            <div class="save-order-box">
                                <input type="submit" class="save-order" value="ثبت و ادامه فرایند خرید">
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="product-tab-content" id="sendPr-2">


                        <div class="send-money-box">
                            <h3 class="send-text">
                                موجودی فعلی:
                                <span class="gray">
                                    <span class="money">0</span>
                                    ریال
                                 </span>
                            </h3>
                        </div>

                        <div class="save-order-box"><a href="#" class="save-order">ثبت و ادامه فرایند خرید</a></div>
                    </div>
                </div>
                <!-- send-product-main end -->

            </div>

        </section>
    </main>
    <script src="{{ frontendTheme('js/order-proses.js') }}"></script>
@endsection
