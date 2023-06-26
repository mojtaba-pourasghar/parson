@extends('layouts.single')
@section('title',$textile->title)
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>$textile->title,'description'=>$textile->title,'image'=>''])
@endsection
@section('content')
    <link rel="stylesheet" href="{{ frontendTheme('css/light.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/rateyo/jquery.rateyo.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/custom-scroll/jquery-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/swiper/swiper-bundle.min.css') }}">

    <main>
        <!-- start single trend cover photo   -->


        <div class="tool-box-top">
            <!--<a href="#" class="pr-img-link pr-share"><i class="icon icon-share"></i></a>-->

            @if(auth()->check())
                <a href="javascript:void(0)" id="bookmark"
                   class="pr-img-link pr-save"><i
                        class="icon icon-save"></i></a>
            @else
                <a href="{{ route('login') }}" class="pr-img-link pr-save"><i
                        class="icon icon-save"></i></a>
            @endif
            <h2 class="header-title">
                <a class="header-link" href="{{ route("basket.list") }}">
                    <span class="header-icon">
                        <i class="icon icon-shopping-cart"></i>
                        <span class="number-basket header_basket" id="header_basket">0</span>
                    </span>
                </a>

            </h2>
            <a href="{{ route('home') }}" class="tool-box-back">
                <i class="fal fa-angle-left"></i>
            </a>
        </div>
        <div class="fabric-slider-box">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($textile->images as $image)
                        <div class="fabric-slide swiper-slide">
                            <a href="#" class="coverfabric-box">
                                <img src="{{ $image->image}}"
                                     alt="{{ $textile->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- end single trend cover photo   -->

        <div class="default-full-container">

            <div class="singlePr-main-section">
                <h1 class="product-content-title">
                    <a href="#">{{ $textile->title }}</a>
                </h1>
                @if ($textile->sum_off >0)
                    <span class="discount">
                                    {{ "٪ ".(int) $textile->sum_off }}
                                </span>
                @endif
            <!--<div class="product-type">
                    <span class="type-icon">
                        <i class="icon icon-original"></i>
                    </span>
                    اصلی
                </div>-->
                <?php
                $main_price = $textile->price;
                ?>
                <div class="pr-price-box">
                    <span class="pr-price-title"> هر متر </span>&nbsp;

                    @if ($textile->price>0 && $textile->sum_discount_price>0 && $textile->price!=$textile->sum_discount_price)
                        <span class="price-descount" id="main_price"
                              data-value="{{ $textile->price }}"> {{ number_format($textile->price) }}  ريال &nbsp;
                        </span>
                        <?php
                        $main_price = $textile->sum_discount_price;
                        ?>
                    @endif
                    <span class="price-total" id="price_with_disscount"
                          data-value="{{ $textile->sum_discount_price }}">{{ ($textile->sum_discount_price>0) ? number_format($textile->sum_discount_price) : number_format($textile->price) }} ريال
                    </span>
                </div>
                @if (!empty($price_pattern_items))
                    <div class="discount-price-row main_property">
                        @foreach($price_pattern_items as $item)
                            <a class="discount-price-item" href="#">

                                {{ $item['min'] }} الي {{ $item['max'] }} متر
                                <div class="discount-row">
                                <!--<span class="pr-percent">{{ $item['off'] * 100 }} % تخفيف</span>-->
                                    <span class="pr-percent">{{ number_format($main_price  - ($item['off'] * $main_price))  }}&nbsp;ريال &nbsp;</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="color-property-box">
                    <span class="color-title">رنگ:</span>
                    <div class="color-box">
                        @foreach($textile->colors as $key =>$color)
                            <a class="color {{ ($key==0) ? 'active' : '' }}" href="#"
                               style="background:{{ $color->color_code }};"
                               data-value="{{ $color->color_code }}"></a>
                        @endforeach
                    </div>


                </div>
                <div class="exist-property-type">
                    @if($textile->available_amount < 5 && $textile->available_amount > 1)
                        @if($textile->unit_measurement=='YARD')
                            {{$textile->available_amount}} يارد موجود در انبار
                        @else
                            {{$textile->available_amount}} متر موجود در انبار
                        @endif
                    @elseif ($textile->available_amount > 5)

                    @else
                        در انبار موجود نيست
                    @endif
                </div>
                <div class="important-property-box">
                    <div class="important-property">
                        <span class="dot-icon"></span>
                        <span class="important-title">آبرفت:</span>
                        <span class="important-name">{{ $textile->shrinking_volume }}</span>
                    </div>
                    <div class="important-property">
                        <span class="dot-icon"></span>
                        <span class="important-title">ساخت:</span>
                        <span class="important-name">{{ $textile->construction }}</span>
                    </div>
                    <!--<div class="important-property">
                        <span class="dot-icon"></span>
                        <span class="important-title"> فصل استفاده:</span>
                        <span class="important-name">پاییز و زمستان</span>
                    </div>
                    <div class="important-property">
                        <span class="dot-icon"></span>
                        <span class="important-title">کاربرد پارچه :</span>
                        <span class="important-name">پالتو سارافون و کت و...</span>
                    </div>-->


                </div>
                <!--<div class="bag-mony-box">

                    <div class="bag-mony-message-box">
                        <span class="corn-icon-box">
                            <span class="icon-corn">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                    class="path4"></span><span class="path5"></span><span class="path6"></span><span
                                    class="path7"></span><span class="path8"></span><span class="path9"></span>
                            </span>
                        </span>
                        <h3 class="bag-mony-title">با خرید این محصول شما</h3>
                        <h3 class="bag-mony-text">۱۵۰ امتیاز در کیف پول پرسون خود دریافت می‌کنید</h3>
                    </div>

                </div>-->

            </div>

            <div class="singlepr-detail-section">

                <div class="singlepr-detail-box">
                    <div class="detail-label-box">
                        <div class="product-label-box column-4">
                            <span class="product-label-icon"><i class="icon icon-barcode"></i></span>
                            <span class="product-label-title">کد محصول</span>
                            <span class="product-label-name">{{$textile->barcode}}</span>
                        </div>
                        <div class="product-label-box column-4">
                            <span class="product-label-icon"><i class="icon icon-static"></i></span>
                            <span class="product-label-title">ایستایی پارچه</span>
                            <span class="product-label-name">{{$textile->static}}</span>
                        </div>
                        <div class="product-label-box column-4">
                            <span class="product-label-icon"><i class="icon icon-height"></i></span>
                            <span class="product-label-title">ضخامت پارچه</span>
                            <span class="product-label-name"> {{$textile->thickness}}</span>
                        </div>
                        <div class="product-label-box column-4">
                            <span class="product-label-icon"><i class="icon icon-width"></i></span>
                            <span class="product-label-title">عرض پارچه</span>
                            <span class="product-label-name">{{$textile->wide}}</span>
                        </div>
                        <div class="product-label-box column-4">
                            <span class="product-label-icon"><i class="icon icon-sample"></i></span>
                            <span class="product-label-title">جنس پارچه</span>
                            <span class="product-label-name"> {{$textile->ware}}</span>
                        </div>
                        <div class="product-label-box column-4">
                            <span class="product-label-icon"><i class="icon icon-design"></i></span>
                            <span class="product-label-title">طرح پارچه</span>
                            <span class="product-label-name"> {{$textile->design}}</span>
                        </div>
                    </div>
                </div>
                <!-- start fabric type  -->
                <div class="fabric-type-box">
                    <h3 class="fabric-title">نوع پارچه </h3>
                    <a class="fabric-type" id="sample_radio" href="javascript:void(0)">
                        <span class="fabric-type-title">نمونه</span>
                        <span class="type-box ">
                            <span class="type-fill"></span>
                        </span>
                    </a>
                    <a class="fabric-type" id="main_radio" href="javascript:void(0)">
                        <span class="fabric-type-title">اصلی</span>
                        <span class="type-box ">
                            <span class="type-fill"></span>
                        </span>
                    </a>
                </div>
                <!-- end fabric type  -->
                <!-- start fabric size -->

                <div class="fabric-size-box main_property" id="fabric-main">
                    <h3 class="fabric-size-title">متراژ</h3>
                    <div class="size-box">
                        <div class="size-input">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                    class="minus" id="centimeter_minus">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="size-title">سانتی متر</span>
                            <input id="cantimetr" class="quantity" min="0" step="10" name="quantity"
                                   value="0"
                                   type="number">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"
                                    id="centimeter_plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <div class="size-input">
                            <span class="size-title"> متر</span>
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                    class="minus" id="meter_minus">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input id="metr" class="quantity" min="0" max="99" name="quantity" value="0"
                                   type="number">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"
                                    id="meter_plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- end fabric size  -->
                <div class="fabric-total-box">
                    <div class="fabric-total-row">
                        <h2 class="fabric-total">مجموع</h2>
                        <h2 class="fabric-total-price" id="sum_price">0 ریال</h2>
                        <input type="hidden" id="sum_price_input" value="0">
                    </div>
                    <div class="add-to-basket-box main_property">
                        <a href="javascript:void(0)" id="add_to_basket_main" class="add-to-basket">افزودن به سبد
                            خرید</a>
                    </div>
                    <div class="add-to-basket-box sample_property">
                        <a href="javascript:void(0)" id="add_to_basket_sample" class="add-to-basket">افزودن به سبد
                            خرید</a>
                    </div>
                </div>

                <div class="important-description-box sample_property">
                    <h3 class="important-description">
                        <span class="info-box"><i class="icon icon-info"></i></span>
                        در هر سفارش برای هر پارچه فقط یکبار امکان دریافت نمونه وجود دارد.
                    </h3>
                    <h3 class="important-description">
                        <span class="info-box"><i class="icon icon-info"></i></span>
                        به ازای هر 5 عدد نمونه پارچه مبلغ 15،000 هزار تومان هزینه دریافت می گردد.
                    </h3>
                </div>
                <div class="more-description-box">
                    <h3 class="description-heading">توضیحات</h3>
                    <div class="description-box">
                        {!! $textile->present()->descriptionHtml  !!}
                    </div>
                </div>
                <!--<h2 class="singlepr-video-title"><a href="#">برسی ویدیویی</a></h2>
                <div class="singlepr-video-section">
                    <video
                        id="my-video"
                        class="video-js"
                        controls
                        preload="auto"
                        poster="static/media/Wrath-of-Man.PNG"
                        data-setup=''
                    >
                        <source src="static/media/Wrath-of-Man.mp4" type="video/mp4"/>


                    </video>

                </div>-->
            </div>

        </div>
        <script>

            var price_pattern = [];
            <?php foreach ($price_pattern_items as $item) : ?>
            price_pattern.push(['<?php echo $item['min']?>', <?php echo $item['max']?>, <?php echo $item['off']?>]);
            <?php endforeach; ?>


            $('#bookmark').click(function () {


                var url = '{{ route("bookmark.add") }}';
                openLoading();
                $.ajax({
                    url: url,
                    type: 'post',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        'textile_id': '{{ $textile->id }}',
                    },
                    datatype: 'json',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                        closeloading();
                    },
                    error: function (xhr, textStatus, thrownError) {
                        toastr.error(__the_operation_failed);
                        closeloading();
                    }
                });
            });
            _price = '{{ $textile->price }}';
            _sum_discount_price = '{{ ($textile->sum_discount_price>0) ? $textile->sum_discount_price : $textile->price }}';
            _avaiable_amount = '{{ $textile->available_amount }}';

            $('#add_to_basket_main').click(function () {
                var unit_measurement = 'METER';
                var color = '';
                if ('{{$textile->unit_measurement}}' == 'YARD')
                    unit_measurement = 'YARD';
                $('.color-box').children('a').each(function () {
                    if ($(this).hasClass('active'))
                        color = $(this).attr("data-value");
                });

                metr = $('#metr').val();
                cantimetr = $('#cantimetr').val();
                var totalTextile = parseInt(metr) + cantimetr / 100;

                if (totalTextile <= 0) {
                    toastr.error('اندازه پارچه انتخاب نشده است');
                    return;
                }

                add_to_basket('{{ csrf_token() }}',
                    '{{ $textile->id }}',
                    unit_measurement,
                    color,
                    'MAIN',
                    '{{ (count($textile->images)>0) ? $textile->images[0]->image : ''}}',
                    '{{ $textile->title }}',
                    '{{ $textile->slug }}',
                    $('#sum_price_input').val(),
                    totalTextile);
            });

            $('#add_to_basket_sample').click(function () {
                var unit_measurement = 'METER';
                var color = '';

                $('.color-box').children('a').each(function () {
                    if ($(this).hasClass('active'))
                        color = $(this).attr("data-value");
                });

                add_to_basket('{{ csrf_token() }}',
                    '{{ $textile->id }}',
                    unit_measurement,
                    color,
                    'SMAPLE',
                    '{{ (count($textile->images)>0) ? $textile->images[0]->image : ''}}',
                    '{{ $textile->title }}',
                    '{{ $textile->slug }}',
                    -1,
                    -1);
            });

        </script>
        @if (!empty($hashtagtextiles))
            <div class="default-full-container">
                <div class="product-main-box yellow-main-box">
                    <div class="main-box-header pink-header-main">
                        <h2 class="main-box-title">سایر &nbsp; رنگ ها</h2>
                    </div>
                    <div class="scrolling-wrapper">
                        @foreach($hashtagtextiles as $textile)
                            @include(currentFrontView('partials.textiles.last'),['type'=>'discount','texttile'=>$textile])
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="default-full-container">
                <div class="product-main-box yellow-main-box">
                    <div class="main-box-header pink-header-main">
                        <h2 class="main-box-title">محصولات مشابه</h2>
                    </div>
                    <div class="scrolling-wrapper">
                        @foreach($sametextiles as $textile)
                            @include(currentFrontView('partials.textiles.last'),['type'=>'discount','texttile'=>$textile])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script src="{{ frontendTheme('js/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ frontendTheme('js/product.js') }}"></script>
    <script src="{{ frontendTheme('js/single-fabric.js') }}"></script>
@endsection
