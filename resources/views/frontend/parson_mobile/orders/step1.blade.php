@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('order.step1'))
@section('back_url',route('basket.list'))
@php
    $has_basket = true;
@endphp
@section('content')
    <main>
        <div class="default-full-container">
            <div class="order-process-navbox">
                <div class="process-nav-bar">
                    <div class="process-item success"></div>
                    <div class="process-item"></div>
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
            <div class="order-pr-main">

                <div class="pr-detail-box column-12">
                    <h3 class="pr-main-title">آدرس تحویل</h3>
                    <div class="pr-content-row">
                        <span class="pr-content-title">آدرس: </span>
                        <span class="pr-content-text">{{ $userDetail->address }}</span>
                    </div>
                    <div class="pr-content-row">
                        <span class="pr-content-title">گیرنده: </span>
                        <span class="pr-content-text">{{ $userDetail->recipient_name }}</span>
                    </div>
                    <div class="pr-content-row">
                        <span class="pr-content-title">شماره موبایل: </span>
                        <span class="pr-content-text">{{ $userDetail->telephon }} </span>
                    </div>
                    <div class="pr-content-row">
                        <a href="{{ route('userdetail.edit',$userDetail->id).'?redirect=step1' }}" class="edit-link">ویرایش</a>
                    </div>
                </div>
                <div class="pr-detail-box column-12 align-items-center justify-content-center" style="height: 300px;width: 100%;">

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
                <div class="form-group-box justify-content-center">
                    <a href="{{ route('order.step2') }}" class="submit-btn">ادامه فرايند خريد</a>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ frontendTheme('js/order-proses.js') }}"></script>
@endsection
