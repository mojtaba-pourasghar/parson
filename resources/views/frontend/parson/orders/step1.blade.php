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
                        <a href="#">روش ارسال</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <div class="order-proses-navbox">
                    <div class="proses-nav-bar"></div>
                    <div class="proses-nav-item proses-nav-pass">
                        <span class="icon icon-fast-delivery left"></span>
                    </div>
                    <div class="proses-nav-item">
                        <span class="icon icon-credit-pass"></span>
                    </div>
                    <div class="proses-nav-item">
                        <span class="icon icon-check-mark"></span>
                    </div>
                </div>
                <div class="order-detail-box">
                    <div class="detail-box-column8">
                        <h2 class="detail-main-title">آدرس تحویل</h2>
                        <h3 class="detail-content">
                            آدرس:
                            <span class="gray">
                                {{ $userDetail->address }}
                            </span>
                        </h3>
                        <h3 class="detail-content">گیرنده:
                            <span class="gray">{{ $userDetail->recipient_name }}</span>
                        </h3>
                        <h3 class="detail-content">شماره موبایل:
                            <span class="gray">{{ $userDetail->telephon }}</span>
                        </h3>
                        <div class="change-detail-box"><a href="{{ route('userdetail.edit',$userDetail->id).'?redirect=step1' }}">تغییرات یا ویرایش آدرس</a></div>
                    </div>
                    <div class="detail-box-column4">
                        <div class="detail-map-box">
                            <script src="https://addmap.parsijoo.ir/leaflet/leaflet.js"></script>
                            <link rel="stylesheet" href="https://addmap.parsijoo.ir/leaflet/leaflet.css" />

                            <div id="mapid" style="width: 100%; height: 100%;"></div>
                            <script>

                                var century21icon = L.icon({
                                    iconUrl: "{{ frontendTheme('images/marker.png') }}",
                                    iconSize: [60, 60]
                                });

                                var mymap = L.map('mapid').setView([{{ $userDetail->latitude }}, {{ $userDetail->longitude }}], 15);
                                L.tileLayer('https://developers.parsijoo.ir/web-service/v1/map/?type=tile&x={x}&y={y}&z={z}&apikey=02f6631ab9384172a5be082cd165f397', {
                                    maxZoom: 21,
                                }).addTo(mymap);
                                var marker = new L.marker([{{ $userDetail->latitude }}, {{ $userDetail->longitude }}],{icon: century21icon}).addTo(mymap);
                            </script>
                        </div>
                    </div>
                </div>
                <!-- send-product-main  -->


                <!-- send-product-main end -->
                <div class="factor-product-box">
                    <h3 class="factor-text">
                        <span class="warning-icon"><i class="icon icon-info"></i></span>
                        شما می‌توانید فاکتور خرید را پس از تحویل سفارش از بخش جزییات سفارش در حساب کاربری خود دریافت
                        کنید.
                    </h3>
                </div>
                <div class="save-order-box"><a href="{{ route('order.step2') }}" class="save-order">ثبت و ادامه فرایند خرید</a></div>
            </div>

        </section>
    </main>
    <script src="{{ frontendTheme('js/order-proses.js') }}"></script>
@endsection
