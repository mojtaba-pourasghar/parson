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
                <div class="main-side-bar">
                    @foreach($discount_issingle_banners as $discount_banner)
                        <div class="side-bar-panel">
                            <a href="{{ route('textile.search').'?discount_type_id='.$discount_banner->id }}">
                                <img src="{{ $discount_banner->thumbnail }}" alt="{{$discount_banner->title}}">
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="main-container-box">
                    <!-- start top fabric  -->
                    <div class="top-fabric-main">
                        <div class="owl-carousel" id="top-fabric-carousel">
                            <div class="fabric-item" data-dot="<button>انواع پارچه</button>">
                                <img src="{{ frontendTheme('images/2594971.jpg') }}">
                            </div>
                            <div class="fabric-item" data-dot="<button>انواع لباس</button>">
                                <img
                                    src="{{ frontendTheme('images/dragon_and_flaming_pearl_chinese_fabrics_background_hd_picture_color_169579.jpg') }}">
                            </div>
                            <div class="fabric-item" data-dot="<button>انواع دوخت</button>">
                                <img src="{{ frontendTheme('images/watercolor-painting-dyeing.jpg') }}" alt="">
                            </div>
                            <div class="fabric-item" data-dot="<button>انواع طرح</button>">
                                <img src="{{ frontendTheme('images/121855-colorful-macro-fabric-748x468.jpg') }}"
                                     alt="">
                            </div>

                        </div>
                    </div>
                    <!-- end top fabric  -->
                    <!-- start fabric off main  -->
                    <div class="fabric-off-main">
                        <div class="fabric-off-right">
                            <div class="fabric-title-price">
                                <div class="off-title-box">
                                    <h3 class="off-title">تخفیف ها</h3>
                                </div>
                                <div class="ftp-title">
                                    <h3 class="ftp-title-text">
                                        <a href="#">پارچه طرح چهارخونه</a>
                                    </h3>
                                </div>
                                <div class="ftp-price">
                                    <div class="ftp-price-primary">۲۵۰٫۰۰۰<span> تومان</span></div>
                                    <div class="ftp-price-off">
                                        ۱۹۸٫۰۰۰<span> تومان</span>
                                    </div>
                                </div>
                            </div>
                            <div class="fabric-slider-circle">
                                <div class="swiper-container ">
                                    <div class="swiper-wrapper">
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-1.jpeg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-2.jpeg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-3.jpg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-2.jpeg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-3.jpg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-4.jpeg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-3.jpg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-2.jpeg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-3.jpg') }}" alt="">
                                            </div>
                                        </a>
                                        <a href="#" class="swiper-slide fsc">
                                            <div class="fsc-img-box">
                                                <img src="{{ frontendTheme('images/parcheh-3.jpg') }}" alt="">
                                            </div>
                                        </a>

                                    </div>

                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination swiper-pagination"></div>
                                </div>
                                <!-- Add Arrows -->
                                <div class="slideNext-btn">
                                    <i class="fal fa-angle-left"></i>
                                </div>
                                <div class="slidePrev-btn">
                                    <i class="fal fa-angle-right"></i>
                                </div>
                            </div>

                        </div>
                        <div class="fabric-off-left">
                            <div class="fabric-circle-add-to">
                                <div class="owl-carousel" id="fabric-off-carousel">
                                    <div class="fabric-off-item">
                                        <div class="off-img-box">
                                            <a href="#">
                                                <img src="{{ frontendTheme('images/parcheh-1.jpeg') }}" alt="">
                                            </a>
                                        </div>
                                        <div class="off-fabric-box">

                                            ۲۰
                                            <span class="percent-icon">
                                            <i class="icon icon-percent"></i>
                                        </span>
                                        </div>
                                        <a class="add-icon-box" href="#"><i class="fal fa-plus"></i></a>
                                    </div>
                                    <div class="fabric-off-item">
                                        <div class="off-img-box">
                                            <a href="#">
                                                <img src="{{ frontendTheme('images/parcheh-2.jpeg') }}" alt="">
                                            </a>
                                        </div>
                                        <div class="off-fabric-box">
                                            ۳۰
                                            <span class="percent-icon">
                                            <i class="icon icon-percent"></i>
                                        </span>
                                        </div>
                                        <a class="add-icon-box" href="#"><i class="fal fa-plus"></i></a>
                                    </div>
                                    <div class="fabric-off-item">
                                        <div class="off-img-box">
                                            <a href="#">
                                                <img src="{{ frontendTheme('images/parcheh-3.jpg') }}" alt="">
                                            </a>
                                        </div>
                                        <div class="off-fabric-box">
                                            ۲۰
                                            <span class="percent-icon">
                                            <i class="icon icon-percent"></i>
                                        </span>
                                        </div>
                                        <a class="add-icon-box" href="#"><i class="fal fa-plus"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="fabric-off-time">
                                <div id="countdown4" class="ClassyCountdownDemo"></div>
                            </div>
                        </div>

                    </div>
                    <!-- end fabric off main  -->

                </div>
            </div>
            <div class="main-full-container">

            @include(currentFrontView('partials.subscription'))

            <!-- featured-box -->
                <div class="featured-box">
                    @foreach($discount_banners as $discount_banner)
                        <a href="{{ route('textile.search').'?discount_type_id='.$discount_banner->id }}"
                           class="featured-item featured-col-4">
                            <img src="{{ $discount_banner->thumbnail }}" alt="{{$discount_banner->title}}">
                        </a>
                    @endforeach
                </div>
                <!-- end featured box  -->
                <!-- product carousel offer -->
                <div class="product-carousel-section product-off-section">
                    <div class="product-title-box">
                        <h3 class="p-title-text">جدید ترینها</h3>
                    </div>
                    <div class="product-main-box">
                        <div class="product-carousel-box">
                            <div class="owl-carousel" id="carousel-off-product">
                                @foreach($newers as $textile)
                                    @include(currentFrontView('partials.textiles.last'),['type'=>'new','texttile'=>$textile])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product carousel offer-->
                <!-- featured box -->
                <div class="featured-box">
                    <a href="{{ route('trend.last',[0,0]) }}" class="featured-item featured-col-6">
                        <img src="{{ frontendTheme('images/women.png') }}" alt="">
                    </a>
                    <a href="{{ route('trend.last',[1,0]) }}" class="featured-item featured-col-6">
                        <img src="{{ frontendTheme('images/mans.png') }}" alt="">
                    </a>

                </div>
                <!-- end featured box -->
                <!-- product carousel new -->
                <div class="product-carousel-section product-new-section">
                    <div class="product-title-box">
                        <h3 class="p-title-text">تخفیفی ها</h3>
                    </div>
                    <div class="product-main-box">
                        <div class="product-carousel-box">
                            <div class="owl-carousel" id="carousel-top-product">
                                @foreach($last_discounts as $textile)
                                    @include(currentFrontView('partials.textiles.last'),['type'=>'discount','texttile'=>$textile])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product carousel new -->
            </div>
        </section>
    </main>
@endsection
