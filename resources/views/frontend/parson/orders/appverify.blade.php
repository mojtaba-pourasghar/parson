@extends('layouts.frontend_app')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            height: 100vh;
            min-width: 0px;
            max-width: 100%;
        }

        .container {
            height: 100%;
        }
        h3{
            font-size: 17px;
        }
        h3 span{
            float: right;
        }
    </style>
    <div class="container text-center d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="profile-main-content col-12">
                <div class="profile-content-box">
                    <div class="transaction-title-box">

                        <a href="{{ route('wallet.add') }}" class="pr-title">اطلاعات برگشتی از بانک</a>
                    </div>
                    <div class="transaction-bank-box col-12">
                        <h3 class="transaction-alert col-12">
                            @if(!empty($ReferenceId))
                                <span class="tr-alert-circle success">
                                         <i class="fa fa-check"></i>
                                       </span>
                                سفارش شما با موفقیت در پرسون ثبت شد
				<h3 class="proses-content col-12"> در 24 ساعت آینده سفارش به دستتان خواهد رسید </h3>
                            @else
                                <span class="tr-alert-circle warning">
                                         <i class="fa fa-check"></i>
                                       </span>

                                {{ $message }}
                            @endif

                        </h3>

                        <div class="col-8 ">
                            <h3 class="transaction-detail">
                                <span class="tr-text">تاریخ :</span>
                                <div class="tr-num">{{ $create_at }}</div>
                            </h3>
                            <h3 class="col-12">
                                <span class="tr-text">ساعت :</span>
                                <div class="tr-num">{{ date('h:i') }}</div>
                            </h3>
                        </div>
                        <div class="col-12">
                            <h3 class="transaction-detail">
                                <span class="tr-text">شماره پیگیری :</span>
                                <div class="tr-num">{{ $ReferenceId }}</div>
                            </h3>
                        </div>
                        <div class="col-12">
                            <h3 class="transaction-detail">
                                <span class="tr-text">کد سفارش:</span>
                                <div class="tr-num"> {{ $ordercode }}</div>
                            </h3>
                        </div>

                        <div class="col-12">
                            <a href="myorder://returnOrderApp?status={{ $success }}&ordercode={{ $ordercode }}" class="return-button">بازگشت</a>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>


@endsection
