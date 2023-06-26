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
                        <a href="{{ route('home') }}">صفحه نخست
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
                        <div class="sidebar-title-box green-title">
                            <a href=""><h3 class="sidebar-title">آخرین ترند ها</h3></a>
                        </div>
                        <div class="sidebar-option-box mCustomScrollbar">
                            @foreach($lastTrends as $lastTrend)
                                <div class="option-item-box">
                                    <div class="thumbnail-box column-2">
                                        <a href="{{ route('trend.view',[$lastTrend->id,$lastTrend->slug]) }}"><img src="{{ $lastTrend->thumbnail }}" alt="{{ $lastTrend->title }}"></a>
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

                    <!--<div class="sidebar-panel-box">
                        <div class="sidebar-title-box red-title">
                            <a href="#"><h3 class="sidebar-title">همه چیز در مورد پارچه ها</h3></a>
                        </div>
                        <div class="sidebar-option-box all-fabric-option mCustomScrollbar">
                            <div class="option-item-box border-violet">

                                <div class="post-box column-12">

                                    <p>
                                        صدای بهم مالیدن پارچه ساتن
                                        احساس براقی، لوکس بودن، و نرمی را القا می کند
                                    </p>
                                    <span class="date-box">۹۹/۰۹/۱۰</span>
                                </div>
                                <span class="separate-bar-violet"></span>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-panel-box">
                        <div class="sidebar-title-box green-title">
                            <a href="#"><h3 class="sidebar-title">آرشیو مطالب</h3></a>
                        </div>
                        <div class="sidebar-option-box archive-option mCustomScrollbar">
                            <div class="option-item-box">

                                <div class="post-box column-12">
                                    <h3 class="post-box-title">
                                        <a href="#">مد سال ۲۰۱۹</a>
                                    </h3>
                                    <p>
                                        دال لورم ایپسوم لورم ایپسوم لورم ایپسوم
                                        لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم
                                        لورم ایپسوم لورم ایپسوم لورم ایپسوم

                                    </p>
                                    <span class="date-box">۹۹/۰۹/۱۰</span>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>

                <div class="default-content-section single-post-content column-9">
                    <!-- start content post  -->
                    <div class="last-teaser-box">
                        <a href="{{ route('trend.last',[0,0]) }}" class="teaser-column6"><img
                                src="{{ frontendTheme('images/women.png') }}" alt=""></a>
                        <a href="{{ route('trend.last',[1,0]) }}" class="teaser-column6"><img
                                src="{{ frontendTheme('images/mans.png') }}" alt=""></a>
                    </div>
                    <!-- end last teaser 	 -->
                    <div class="last-category-box">
                        @foreach($trendtags as $trendtag)
                            <a href="{{ route('trend.last',[-1,$trendtag->id]) }}"
                               class="category-item">{{ $trendtag->title }}</a>
                        @endforeach
                    </div>
                    @foreach ($category_trends as $category_trend)
                        <div class="more-sell-main">
                            <div class="product-title-box">
                                <h3 class="p-title-text"> {{ $category_trend->title }} </h3>
                            </div>
                            <div class="more-content-box">
                                @foreach($category_trend->trends as $trend)
                                    <div class="more-content-column6">
                                        <a class="image-box" href="{{ route('trend.view',[$trend->id,$trend->slug]) }}">
                                            <img src="{{ $trend->thumbnail }}" alt="{{ $trend->title }}"></a>
                                        <h3 class="more-sell-title"><a
                                                href="{{ route('trend.view',[$trend->id,$trend->slug]) }}">{{ $trend->title }}</a>
                                        </h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- news main content end -->

            </div>
            <div class="main-full-container">


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
