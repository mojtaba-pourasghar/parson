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
                        <a href="{{ route("home") }}">صفحه نخست
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">سبد خرید</a>

                    </h2>
                </div>
            </div>
            <div class="main-full-container">
                <!-- start profile main  -->
                <div class="profile-main">
                    <div class="shoping-list-box column-8">
                        <div class="shoping-main">
                            <div class="shoping-header-box">
                                <h2 class="shoping-title">
                                    <span
                                        class="number-pr">{{ (!empty($Basket_Info)) ? count($Basket_Info) : "0" }}</span>
                                    سبد خرید
                                </h2>
                            </div>
                            @php
                                $sum_price_discount = 0;
                                $sum_price = 0;
                            @endphp
                            @if(!empty($Basket_Info))
                                @foreach($Basket_Info as $item)
                                    <div class="shoping-list-row">
                                        <div class="shoping-row-box">
                                            <div class="shoping-right-column column-6">
                                                <a class="shoping-thumb-box"
                                                   href="{{ getTextileLink($item['textile_id'],$item['slug']) }}"><img
                                                        src="{{ $item['image'] }}" alt=""></a>
                                                <div class="shoping-detail-box">
                                                    <div class="shoping-title-box">
                                                        <h2 class="shoping-title">{{ $item['title'] }}</h2>
                                                        <h3 class="shoping-type" style="margin-top: 10px">
                                                            @if ($item['type'] == 'MAIN')
                                                                <span class="shoping-type-icon">
                                                               <i class="icon icon-original"></i>
                                                           </span>
                                                                اصلی
                                                            @else
                                                                <span class="shoping-type-icon">
                                                                    <i class="icon icon-sample"></i>
                                                                </span>
                                                                نمونه
                                                            @endif
                                                        </h3>

                                                        <div class="color-property-box " style="margin-top: 5px">
                                                            <span class="color-title ">رنگ:</span>
                                                            <span class="color-name"></span>
                                                            <div class="color-box">
                                                                <a class="color" href="#"
                                                                   style="background:{{ $item['color'] }};"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="shoping-delete-box">
                                                        <a href="{{ route('basket.delete',$item['textile_id']) }}"
                                                           class="delete-box">
                                                        <span class="delete-icon-box">
                                                            <i class="icon icon-bin"></i>
                                                        </span>
                                                            حذف از سبد خرید
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="shoping-left-column column-6">
                                                <div class="shoping-size-box">
                                                    @if ($item['type'] == 'MAIN')
                                                        <span class="size-text">اندازه</span>
                                                        <span class="size-number">{{ $item['requested_size'] }}</span>
                                                        <span class="size-unit">
                                                        @if ($item['unit_measurement']=='METER')
                                                                متر
                                                            @else
                                                                یارد
                                                            @endif

                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="shoping-price-box">
                                                    @if ($item['type'] == 'MAIN')
                                                        <div class="shoping-price-row">
                                                            @if ($item['sum_price'] != $item['sum_price_discount'])
                                                                <span class="primary-price-throw">
                                                               {{ number_format($item['sum_price']) }}
                                                                <span class="price-text">ریال</span>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @if ($item['sum_price']!=0)
                                                            <div class="shoping-price-row">
                                                        <span class="discont-price">
                                                            <span class="discont-text">تخفیف:</span>
                                                            {{ number_format($item['sum_price'] - $item['sum_price_discount']) }}
                                                            <span class="price-text">ریال</span>
                                                        </span>
                                                            </div>
                                                            <div class="shoping-price-row">
                                                        <span class="main-price">
                                                            {{ number_format($item['sum_price_discount']) }}
                                                            <span class="price-text">ریال</span>
                                                        </span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @php
                                                        $sum_price_discount += $item['sum_price_discount'];
                                                        $sum_price += $item['sum_price'];
                                                    @endphp
                                                    <div class="shoping-price-row">
                                                        <!--<div class="shoping-corn-box">
                                                            <span class="icon-corn">
                                                                <span class="path1"></span><span class="path2"></span><span
                                                                    class="path3"></span><span class="path4"></span><span
                                                                    class="path5"></span><span class="path6"></span><span
                                                                    class="path7"></span><span class="path8"></span><span
                                                                    class="path9"></span>
                                                            </span>
                                                        </div>
                                                        <span class="corn-num">
                                                            50
                                                            <span class="price-text">سکه</span>
                                                        </span>-->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="shoping-order-box column-4">
                        <div class="shoping-address-box">
                            <h2 class="address-title">

                    <span class="address-icon-box">
                        <i class="icon icon-location"></i>
                    </span>
                                ارسال به
                            </h2>
                            <div class="address-main-box">
                                <h3 class="address-main-text">
                                    {{ $userDetail->address }}
                                </h3>
                                <a href="{{ route('userdetail.addresses') }}" class="address-btn-icon">
                                    <i class="fal fa-angle-left"></i>
                                </a>
                            </div>
                        </div>
                        <div class="shoping-price-box">
                            <div class="shoping-price-row">
                                <div class="shoping-col-box column-6">
                                    <div class="shoping-title-box">
                                        <h3 class="shoping-title primary-color">مجموع قیمت سبد خرید:</h3>
                                    </div>
                                </div>
                                <div class="shoping-col-box column-6">
                                    <div class="shoping-price-main">
                                        <span class="price-num-box primary-color">{{ number_format($sum_price) }}</span>
                                        <span class="price-num-text primary-color">ریال</span>
                                    </div>
                                </div>

                            </div>
                            <div class="shoping-price-row">
                                <div class="shoping-col-box column-6">
                                    <div class="shoping-title-box">
                                        <h3 class="shoping-title discont-color">مجموع تخفیف:</h3>
                                    </div>
                                </div>
                                <div class="shoping-col-box column-6">
                                    <div class="shoping-price-main">
                                        <span
                                            class="price-num-box discont-color">{{ number_format($sum_price - $sum_price_discount) }}</span>
                                        <span class="price-num-text discont-color">ریال</span>
                                    </div>
                                </div>

                            </div>
                            <div class="shoping-price-row">
                                <div class="shoping-col-box column-6">
                                    <div class="shoping-title-box">
                                        <h3 class="shoping-title main-color">مبلغ قابل پرداخت:</h3>
                                    </div>
                                </div>
                                <div class="shoping-col-box column-6">
                                    <div class="shoping-price-main">
                                        <span
                                            class="price-num-box main-color">{{ number_format($sum_price_discount) }}</span>
                                        <span class="price-num-text main-color">ریال</span>
                                    </div>
                                </div>

                            </div>
                            <!--  <div class="shoping-price-row">
                                <div class="shoping-col-box column-6">
                                     <div class="shoping-title-box">
                                         <h3 class="shoping-title primary-color">
                                             امتیاز:
                                             <div class="shoping-corn-box">
                                                 <span class="icon-corn">
                                                     <span class="path1"></span><span class="path2"></span><span
                                                         class="path3"></span><span class="path4"></span><span
                                                         class="path5"></span><span class="path6"></span><span
                                                         class="path7"></span><span class="path8"></span><span class="path9"></span>
                                                 </span>
                                             </div>

                                         </h3>
                                     </div>
                                 </div>
                                 <div class="shoping-col-box column-6">
                                     <div class="shoping-price-main">
                                         <span class="price-num-box primary-color">150</span>
                                         <span class="price-num-text primary-color">امتیاز</span>
                                     </div>
                                 </div>

                            </div>-->
                            <div class="shoping-price-row">
                                <!--<div class="price-button-row">
                                    <a href="#" class="button-red discont-btn">اعمال کد تخفیف</a>
                                    <a href="#" class="button-red gift-btn">اعمال کد هدیه</a>
                                </div>-->
                                <div class="price-button-row">
                                    <a href="{{ route('order.step1') }}" class="order-btn">تکمیل و ثبت سفارش </a>
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
