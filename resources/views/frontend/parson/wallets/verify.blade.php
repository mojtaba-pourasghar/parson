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
                                <a href="{{ route('wallet.add') }}" class="pr-title">اطلاعات برگشتی از بانک</a>
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
