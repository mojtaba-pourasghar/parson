@extends('layouts.frontend')
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
        <section>
            <div class="main-content-box">
                <div class="default-title-box site-map">
                    <h2 class="default-title">
                        <a href="{{ route('home') }}">صفحه نخست
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="{{ route('textile.search') }}">
                            محصولات
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">{{ $textile->title }}</a>

                    </h2>
                </div>


            </div>
            <div class="main-full-container">
                <div class="main-content-box product-main-container">
                    <!-- product main content start  -->
                    <div class="product-img-main column-3">

                        <div class="single-fabric-slider">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($textile->images as $image)
                                        <div href="#" class="product-img-box swiper-slide">
                                            <div class="img-link-box">
                                                <!--<a href="#" class="pr-img-link pr-share"><i class="icon icon-share"></i></a>-->
                                                @if(auth()->check())
                                                    <a href="javascript:void(0)" id="bookmark"
                                                       class="pr-img-link pr-save"><i
                                                            class="icon icon-save"></i></a>
                                                @else
                                                    <a href="{{ route('login') }}" class="pr-img-link pr-save"><i
                                                            class="icon icon-save"></i></a>
                                                @endif
                                            </div>

                                            <img src="{{ $image->image}}"
                                                 alt="{{ $textile->title }}">

                                        </div>
                                    @endforeach
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                    <div class="product-content-main column-9">
                        <div class="product-content-header">
                            <h1 class="product-content-title">
                                <a href="#"></a>

                            </h1>

                            @if ($textile->sum_off >0)
                                <span class="discount">
                                    {{ (int) $textile->sum_off." ٪" }}
                                </span>
                            @endif

                        </div>
                        <div class="product-main-detail">
                            <div class="property-box column-7">
                                <h2 class="property-heading">ویژگی محصول</h2>
                                <div class="property-content-main">

                                    <div class="exist-property-type">
                                        @if($textile->available_amount < 5 && $textile->available_amount > 1)
                                            @if($textile->unit_measurement=='YARD')
                                                {{$textile->available_amount}} یارد موجود در انبار
                                            @else
                                                {{$textile->available_amount}} متر موجود در انبار
                                            @endif
                                        @elseif ($textile->available_amount > 5)

                                        @else
                                            در انبار موجود نیست
                                        @endif
                                    </div>
                                    <div class="fabric-size-section">
                                        <div class="fabric-type-box">
                                            <h3 class="fabric-title">نوع پارچه </h3>
                                            <a class="fabric-type" id="main_radio" href="javascript:void(0)">
                                                <span class="fabric-type-title type-title-active">اصلی</span>
                                                <span class="type-box ">
                                            <span class="type-fill"></span>
                                        </span>
                                            </a>
                                            <a class="fabric-type" id="sample_radio" href="javascript:void(0)">
                                                <span class="fabric-type-title">نمونه</span>
                                                <span class="type-box ">
                                            <span class="type-fill"></span>
                                        </span>
                                            </a>

                                        </div>


                                    </div>
                                    <?php
                                    $main_price = $textile->price;
                                    ?>
                                    @if ($textile->price>0 && $textile->sum_discount_price>0 && $textile->price!=$textile->sum_discount_price)
                                        <?php
                                        $main_price = $textile->sum_discount_price;
                                        ?>
                                    @endif
                                    @if (!empty($price_pattern_items))
                                        <div class="fabric-percent-main main_property">
                                            <div class="fabric-percent-box">
                                                @foreach($price_pattern_items as $item)
                                                    <div class="percent-item-box">
                                                        <span
                                                            class="pr-size">{{ $item['min'] }} الی {{ $item['max'] }} متر</span>
                                                        <span class="pr-percent">{{ number_format($main_price  - ($item['off'] * $main_price))  }}&nbsp;ريال &nbsp;</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

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

                                    <div class="color-property-box">
                                        <span class="color-title">رنگ:</span>
                                        <span class="color-name"></span>
                                        <div class="color-box">
                                            @foreach($textile->colors as $key =>$color)
                                                <a class="color {{ ($key==0) ? 'active' : '' }}" href="#"
                                                   style="background:{{ $color->color_code }};"
                                                   data-value="{{ $color->color_code }}"></a>
                                            @endforeach
                                        </div>
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


                                    </div>
                                    <div class="property-more-box">
                                        <div class="important-property">
                                            <span class="dot-icon"></span>
                                            <span class="important-title">  مورد بیشتر:</span>
                                            <span class="important-name">ندارد</span>
                                        </div>
                                        <div class="important-property">
                                            <span class="dot-icon"></span>
                                            <span class="important-title"> مورد بیشتر:</span>
                                            <span class="important-name">پالتو سارافون و کت و...</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="detail-box column-5">
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
                                <!--<div class="bag-money-box">
                                <span class="corn-icon-box">
                                            <span class="icon-corn">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span><span class="path4"></span><span
                                                    class="path5"></span><span class="path6"></span><span
                                                    class="path7"></span><span class="path8"></span><span
                                                    class="path9"></span>
                                            </span>
                                </span>
                                    <div class="bag-money-message-box">
                                        <h3 class="bag-money-title">با خرید این محصول شما</h3>
                                        <h3 class="bag-money-text">۱۵۰ امتیاز در کیف پول پَرسون خود دریافت می‌کنید</h3>
                                    </div>

                                </div>-->
                            </div>

                            <div class="detail-line-bar"></div>

                        </div>

                        <div class="product-main-important">
                            <div class="main-important-content">


                                <div class="price-important-box column-12 main_property">

                                    <div class="fabric-size-box">
                                        <div class="size-input">
                                            <button
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                class="minus" id="centimeter_minus">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="size-title">سانتی متر</span>
                                            <input id="cantimetr" class="quantity" min="0" step="10" name="quantity"
                                                   value="0"
                                                   type="number">
                                            <button
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                class="plus" id="centimeter_plus">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="size-input">
                                            <span class="size-title"> متر</span>
                                            <button
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                class="minus" id="meter_minus">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input id="metr" class="quantity" min="0" max="99" name="quantity" value="0"
                                                   type="number">
                                            <button
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                class="plus" id="meter_plus">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="price-content-box">
                                        <div class="price-detail-box">
                                            <h3 class="price-title">قیمت / هر متر</h3>
                                            <div class="price-box">
                                                @if ($textile->price>0 && $textile->price!=$textile->sum_discount_price && $textile->sum_discount_price>0)
                                                    <span class="price-descount" id="main_price"
                                                          data-value="{{ $textile->price }}"> {{ number_format($textile->price) }} ریال
                                                    </span>
                                                @endif

                                                <span class="price-total" id="price_with_disscount"
                                                      data-value="{{ $textile->sum_discount_price }}">{{ ($textile->sum_discount_price>0) ? number_format($textile->sum_discount_price) : number_format($textile->price) }} ریال</span>
                                                <span class="price-total">جمع کل :</span>
                                                <span class="price-total" id="sum_price">0 ریال</span>
                                                <input type="hidden" id="sum_price_input" value="0">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="addTo-basket-box">
                                        <a href="javascript:void(0)" class="addTo-basket" id="add_to_basket_main">
                                        <span class="addTo-basket-icon">
                                            <i class="icon icon-basket"></i>
                                            <span class="plus-box">
                                                <i class="fal fa-plus"></i>
                                            </span>
                                        </span>
                                            افزودن به سبد خرید
                                        </a>
                                    </div>

                                </div>

                                <div class="price-important-box column-12 sample_property">

                                    <div class="addTo-basket-box">
                                        <a href="javascript:void(0)" class="addTo-basket" id="add_to_basket_sample">
                                        <span class="addTo-basket-icon">
                                            <i class="icon icon-basket"></i>
                                            <span class="plus-box">
                                                <i class="fal fa-plus"></i>
                                            </span>
                                        </span>
                                            افزودن به سبد خرید
                                        </a>
                                    </div>

                                </div>


                            </div>

                        </div>


                    </div>
                    <!-- product main content end -->
                    <div class="product-tab-container">
                        <div class="product-tab-nav">

                            <li class="nav-item active"><a href="#">مشخصات</a></li>
                        </div>

                        <div class="product-content">
                            <div class="product-tab-content">
                                <p>
                                    {!! $textile->present()->descriptionHtml  !!}
                                </p>
                            </div>
                        </div>
                    </div>
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
            <div class="main-full-container">

                <!-- product carousel offer -->
                @if (!empty($hashtagtextiles))

                    <div class="product-carousel-section product-off-section">
                        <div class="product-title-box">
                            <h3 class="p-title-text">سایر &nbsp; رنگ ها</h3>
                        </div>
                        <div class="product-main-box">
                            <div class="product-carousel-box">
                                <div class="owl-carousel" id="carousel-off-product">
                                    @foreach($hashtagtextiles as $textile)
                                        @include(currentFrontView('partials.textiles.last'),['type'=>'discount','texttile'=>$textile])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="product-carousel-section product-off-section">
                        <div class="product-title-box">
                            <h3 class="p-title-text">محصولات مشابه</h3>
                        </div>
                        <div class="product-main-box">
                            <div class="product-carousel-box">
                                <div class="owl-carousel" id="carousel-off-product">
                                    @foreach($sametextiles as $textile)
                                        @include(currentFrontView('partials.textiles.last'),['type'=>'discount','texttile'=>$textile])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            <!-- end product carousel offer-->

                <!-- start subscript  -->
            @include(currentFrontView('partials.subscription'))
            <!-- end subscript  -->

            </div>

        </section>
    </main>

    <script src="{{ frontendTheme('js/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ frontendTheme('js/product.js') }}"></script>
@endsection
