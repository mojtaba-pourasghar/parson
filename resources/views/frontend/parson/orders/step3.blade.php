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
                        <a href="#">ثبت</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="order-proses-navbox">
                    <div class="proses-nav-bar">
                        <div class="proses-item success"></div>
                        <div class="proses-item success"></div>
                        <div class="proses-item success"></div>
                    </div>
                    <div class="proses-nav-item proses-nav-pass">
                        <span class="icon icon-fast-delivery left"></span>
                    </div>
                    <div class="proses-nav-item proses-nav-pass">
                        <span class="icon icon-credit-pass"></span>
                    </div>
                    <div class="proses-nav-item proses-nav-pass">
                        <span class="icon icon-check-mark"></span>
                    </div>
                </div>
                @if (!empty($ReferenceId))
                    <div class="order-detail-box proses-save-box">
                        <h2 class="detail-main-title">سفارش شما با موفقیت در پرسون ثبت شد</h2>
                        <div class="order-proses-content">
                            <h3 class="proses-content"> در 24 ساعت آینده سفارش به دستتان خواهد رسید </h3>
                        </div>
                        <div class="proses-support-content">
                            <h3 class="support-content">شماره پیگیری
                                :
                                <span class="gray">
                                {{ $ReferenceId }}
                            </span>
                            </h3>
                            <h3 class="support-content">کد سفارش:
                                <span class="gray">
                               {{ $ordercode }}
                            </span>
                            </h3>
                        </div>
                    </div>
                @else
                    <div class="order-detail-box proses-save-box">
                        <div class="order-proses-content">
                            <h3 class="proses-content"> درخواست شما ثبت شد ولی پرداخت انجام نشد </h3>
                        </div>
                        <div class="proses-support-content">
                            </h3>
                            <h3 class="support-content">کد سفارش:
                                <span class="gray">
                               {{ $ordercode }}
                            </span>
                            </h3>
                        </div>
                    </div>
                @endif

            </div>

        </section>
    </main>
    <script src="{{ frontendTheme('js/order-proses.js') }}"></script>
@endsection
