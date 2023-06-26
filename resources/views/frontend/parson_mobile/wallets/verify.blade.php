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
    <main>
        <div class="default-full-container">
            <div class="transaction-title-box">

                <a href="#" class="pr-title">اطلاعات برگشتی از بانک</a>
            </div>
            <div class="transaction-bank-box">
                <h3 class="transaction-alert">
                    @if(!empty($ReferenceId))
                        <span class="tr-alert-circle success">
                                         <i class="fa fa-check"></i>
                                       </span>
                        تراکنش با موفقیت انجام شد
                    @else
                        <span class="tr-alert-circle warning">
                                         <i class="fa fa-check"></i>
                                       </span>

                        {{ $message }}
                    @endif

                </h3>
                <div class="transaction-row">
                    <h3 class="transaction-detail">
                        <span class="tr-text">تاریخ :</span>
                        <div class="tr-num">{{ $create_at }}</div>
                    </h3>
                    <h3 class="transaction-detail">
                        <span class="tr-text">ساعت :</span>
                        <div class="tr-num">{{ date('h:i') }}</div>
                    </h3>
                </div>
                <div class="transaction-row">
                    <h3 class="transaction-detail">
                        <span class="tr-text">شماره پیگیری :</span>
                        <div class="tr-num">{{ $ReferenceId }}</div>
                    </h3>
                    <a href="{{ route('wallet.add') }}" class="return-button">بازگشت</a>

                </div>
            </div>

        </div>
    </main>
@endsection
