@extends('layouts.activity')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('header_title',__('wallet.charge_wallet'))
@section('back_url',route('home'))
@php
    $has_basket = true
@endphp
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <div class="default-full-container">
        <div class="credit-box-main">
            <div class="current-credit-box">
                <h2 class="current-credit-title">
                    <span class="credit-title">اعتبار فعلی:</span>
                    <span class="current-validity">{{ number_format($amount) }} ریال</span>
                </h2>
            </div>
            <div class="value-amount-box">
                <a class="value-amount-item column-4 money_box" href="javascript:void(0)" data-value="100,000">
                    <span class="amount-text">1,000,000 ریال</span>
                </a>
                <a class="value-amount-item column-4 money_box" href="javascript:void(0)" data-value="200,000">
                    <span class="amount-text">2,000,000 ریال</span>
                </a>
                <a class="value-amount-item column-4 money_box" href="javascript:void(0)" data-value="300,000">
                    <span class="amount-text">3,000,000 ریال</span>
                </a>
            </div>
            {!! Form::model(null, ['route' => ['wallet.add'] ,'method' => 'post','style'=>'width: 100%;'] ) !!}
                <div class="another-amount-box">
                    <div class="another-amount">
                        <span class="plus-icon">
                            <!--<i class="icon icon-increase_money"></i>-->
                        </span>
                        <input class="another-text" type="text" id="amount" name="amount" placeholder="سایر مبالغ">
                        <span class="minus-icon">
                            <!--<i class="icon icon-decrease_money"></i>-->
                        </span>
                    </div>
                </div>
                <div class="payment-button-box">
                    <button class="submit-btn" type="submit">پرداخت</button>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="transaction-box-main">
            <div class="transaction-title-box">
                <h2 class="transaction-title">تراکنش ها</h2>
            </div>
            <div class="transaction-panel-main mCustomScrollbar">
                @foreach($transactions as $transaction)
                    <div class="transaction-box {{ ($transaction->status == 1 ) ? 'success' : 'dangerous' }}">
                        <div class="transaction-icon">
                            <span class="icon icon-correct"></span>
                        </div>
                        <div class="transaction">
                            <div class="transaction-detail-box">
                                <span class="transaction-pay">{{ number_format($transaction->transaction->amount) }} ریال</span>
                                <span class="transaction-date">
                                 {{ $transaction->transaction->created_at }}
                             </span>
                            </div>
                            <div class="transaction-detail-box">
                                <span class="transaction-tracking">شماره پیگیری:</span>
                                <span class="transaction-num">{{ $transaction->refid }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <script src="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#amount').keyup(function (event) {
                if (event.which >= 37 && event.which <= 40) return;
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
                });
            });
        });
        $(".money_box").click(function () {
            var value = $(this).attr('data-value');
            $("#amount").val(value);
        })
    </script>
@endsection
