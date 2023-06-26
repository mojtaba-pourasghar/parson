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
                        <a href="{{ route('home') }}">@lang('message.home')
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
                            <div class="content-title-box">
                                <h3 class="content-title">اطلاعات کیف پول</h3>
                            </div>
                            <div class="profile-wallet-box column-6">
                                <div class="profile-column-box">
                                    <div class="column-box-title">
                                        <h3 class="credit-title">موجودی فعلی</h3>
                                    </div>
                                    <div class="column-box-info">
                                        <h4 class="info-text">
                                            <span class="money-box">{{ number_format($amount) }} ریال</span>
                                        </h4>

                                    </div>
                                </div>
                                <div class="profile-column-box">
                                    {!! Form::model(null, ['route' => ['wallet.add'] ,'method' => 'post'] ) !!}
                                    <div class="column-box-title">
                                        <h3 class="credit-title">افزایش اعتبار</h3>
                                    </div>
                                    <div class="column-box-info">
                                        <a class="select-credit money_box"   href="javascript:void(0)" data-value="100,000">
                                            <span class="money-box">100/000 ریال</span>
                                        </a>
                                        <a class="select-credit money_box" href="javascript:void(0)" data-value="200,000">
                                            <span class="money-box">200/000 ریال</span>
                                        </a>
                                        <a class="select-credit money_box" href="javascript:void(0)" data-value="300,000">
                                            <span class="money-box">300/000 ریال</span>
                                        </a>
                                    </div>
                                    <div class="column-box-info">
                                        <input type="text" id="amount" name="amount" class="cash-money-input" placeholder="مبلغ مورد نظر">
                                        <input type="submit" class="cash-pay" value="پرداخت">
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                            </div>
                            <div class="profile-credit-box column-6">
                                <div class="profile-column-box profile-transaction-box">
                                    <div class="column-box-title">
                                        <h3 class="credit-title">تراکنش ها</h3>
                                    </div>
                                    <div class="transaction-main mCustomScrollbar">
                                        @foreach($transactions as $transaction)
                                            <div class="transaction-box {{ ($transaction->status == 1 ) ? 'success' : 'dangerous' }}">
                                            <div class="transaction-icon">
                                                <span class="icon  {{ ($transaction->status == 1 ) ? 'icon-Check-box' : 'icon-Error' }}"></span>
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
                                                    <span class="transaction-num">{{ $transaction->refid }} </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

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
