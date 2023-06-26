@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('wallet.charge_wallet'))
@section('back_url',route('wallet.add'))
@php
    $has_basket = true
@endphp
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <main>
        <div class="default-full-container">
            @include('partials.flash-message')
            <div class="pr-charging-main">
                <div class="pr-charging-row">
                    <div class="charging-detail">
                        <span class="detail-text">مبلغ:</span>
                        <span class="detail-num">{{ number_format($PayInfo['sum_price']) }} ریال</span>
                    </div>
                    <div class="charging-detail">
                        <span class="detail-text">تاریخ:</span>
                        <span class="detail-num">{{ $create_at }}</span>
                    </div>
                    <div class="charging-detail">
                        <span class="detail-text">ساعت:</span>
                        <span class="detail-num">{{ date('h:i') }}</span>
                    </div>
                </div>
                <!--<div class="pr-charging-row">
                    <h3 class="pr-charging-title">انتخاب درگاه</h3>
                </div>
                <div class="pr-charging-row">
                    <div class="bank-select-main">
                        <div class="bank-select-box">
                            <div class="select-card-item">
                                <a href="#" class="card-item">
                                    <img src="{{ frontendTheme('images/mellat.png') }}" alt="mellat-bank">
                                </a>
                            </div>
                            <div class="select-card-item">
                                <a href="#" class="card-item">
                                    <img src="{{ frontendTheme('images/parsian.png') }}" alt="parsian-bank">
                                </a>


                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="pr-charging-row">
                    {!! Form::model(null, ['route' => ['wallet.gateway'] ,'method' => 'post','style'=>'width: 100%;'] ) !!}
                        <div class="pr-confirm-box">
                            <input type="submit" class="confirm-button" value="تایید">
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </main>

@endsection
