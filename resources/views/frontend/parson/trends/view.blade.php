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
                        <a href="#">صفحه نخست
                            <span class="default-title-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                        </a>
                        <a href="#">تازه ها</a>

                    </h2>
                </div>


            </div>

            <div class="main-content-box">
                <!-- news main content start  -->
                <div class="default-sidebar column-3">
                    <div class="sidebar-panel-box">
                        <div class="sidebar-title-box violet-title">
                            <a href="#"><h3 class="sidebar-title">پربازدید ترین مطالب</h3></a>
                        </div>
                        <div class="sidebar-option-box mCustomScrollbar">
                            @foreach($lastTrends as $lastTrend)
                                <div class="option-item-box">
                                    <div class="thumbnail-box column-2">
                                        <a href="{{ route('trend.view',[$lastTrend->id,$lastTrend->slug]) }}"><img
                                                src="{{ $lastTrend->thumbnail }}" alt="{{ $lastTrend->title }}"></a>
                                    </div>
                                    <div class="post-box column-8">
                                        <p>
                                            {{ $lastTrend->title }}
                                            <span class="date-box">{{ $lastTrend->created_at }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="default-content-section single-post-content column-9">
                    <!-- start content post  -->
                    <div class="default-content-post">
                        <div class="content-post-column column-12">
                            <div class="post-column-box single-column-box">
                                <a href="#" class="image-box"><img src=" {{ $trend->thumbnail }} "
                                                                   alt="{{ $trend->title }}"></a>
                                <div class="post-pallet-box">
                                    @foreach($trend->colors as $color)
                                        <a href="{{ route('textile.search').'?color='. str_replace('#','',$color->color_code) }}" class="pallet-item">
                                            <span class="pallet-color" style="background: {{ $color->color_code }};"></span>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="post-photo-box">
                                    <div class="post-photo-col3">
                                        <img src="{{ frontendTheme('images/last-1.jpg') }}" alt="">
                                    </div>
                                    <div class="post-photo-col3">
                                        <img src="{{ frontendTheme('images/last-2.jpg') }}" alt="">
                                    </div>
                                    <div class="post-photo-col3">
                                        <img src="{{ frontendTheme('images/last-1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="post-content-main post-single-main column-10">
                                    <h3 class="content-title-box">
                                        <a href="#">{{ $trend->title }}</a>
                                    </h3>
                                    <dive class="single-detail-box">
                                        <div class="right-detail-box column-6">
                                        <!--<div class="social-box">
                                                <a href="#" class="social-icon-box">
                                                    <i class="icon icon-share"></i>
                                                </a>
                                                <a href="#" class="social-icon-box">
                                                    <img src="{{ frontendTheme('images/whatsapp.png') }}" alt="">
                                                </a>
                                                <a href="#" class="social-icon-box">
                                                    <img src="{{ frontendTheme('images/telegram.png') }}" alt="">
                                                </a>

                                                <a href="#" class="social-icon-box">
                                                    <img src="{{ frontendTheme('images/instagram.png') }}" alt="">
                                                </a>
                                            </div>-->
                                            <div class="content-view-box">
                                                <span class="view-title">بازدید</span>
                                                <span class="view-number">{{ $trend->view_count }}</span>
                                            </div>
                                        </div>
                                        <div class="left-detail-box column-6">
                                            <span class="content-date">{{ $trend->created_at }}</span>
                                        </div>
                                    </dive>
                                    <div class="content-text-box">
                                        {!! $trend->present()->bodyHtml  !!}
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <!-- news main content end -->

            </div>
            <div class="main-full-container">

                <!-- product carousel new -->
                <div class="product-carousel-section product-new-section">
                    <div class="product-title-box">
                        <h3 class="p-title-text">کالا های مشابه</h3>
                    </div>
                    <div class="product-main-box">
                        <div class="product-carousel-box">
                            <div class="owl-carousel" id="carousel-top-product">
                                @foreach($trend->textiles as $textile)
                                    @include(currentFrontView('partials.textiles.last'),['type'=>'new','texttile'=>$textile])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product carousel new -->

                <!-- start subscript  -->
            @include(currentFrontView('partials.subscription'))
            <!-- end subscript  -->

            </div>

        </section>
    </main>
    <script src="{{ frontendTheme('js/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ frontendTheme('js/scroll-box/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ frontendTheme('js/last.js') }}"></script>
@endsection
