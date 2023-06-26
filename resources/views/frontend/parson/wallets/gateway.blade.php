@extends('layouts.frontend')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.css') }}">
    <main>
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title">
                        <a href="#">پروفایل
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">افزایش اعتبار </a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->
                <div class="profile-main">
                    @include(currentFrontView('partials.users.edit_profile_right_menu'),['active'=>'1'])
                    <div class="profile-main-content column-7">
                        <div class="profile-content-box">
                            <div class="transaction-title-box">
                                <a href="#" class="pr-ar-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="#" class="pr-title">شارژ کیف پول</a>
                            </div>
                            <div class="pr-charging-main">
                                @include('partials.flash-message')
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
                                                    <img src="images/shop/mellat.png" alt="mellat-bank">
                                                </a>
                                            </div>
                                            <div class="select-card-item">
                                                <a href="#" class="card-item">
                                                    <img src="images/shop/parsian.png" alt="parsian-bank">
                                                </a>


                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="pr-charging-row">
                                    {!! Form::model(null, ['route' => ['wallet.gateway'] ,'method' => 'post'] ) !!}
                                    <div class="pr-confirm-box">
                                        <input type="submit" class="confirm-button" value="تایید">
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>


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
