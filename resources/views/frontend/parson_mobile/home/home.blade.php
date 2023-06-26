@extends('layouts.fragment')
@section('title','پرسون')
@section('keywords','')
@section('description','')
@section('open_graph')
    @include(currentFrontView('partials.open_graph'),['title'=>'پرسون','description'=>'','image'=>''])
@endsection
@section('content')
    <main>


        <!-- start main tab  section -->

        <!-- start profile tab content  -->
        <div class="main-tab-content" id="profile-tab">
            @if(auth()->check())
                <div class="main-header">
                    @include(currentFrontView('partials.basket_icon'))
                    <div class="header-center">
                        <h2 class="header-title">پروفایل</h2>
                    </div>
                    <div class="header-left">
                        <h2 class="header-title">
                            <a class="header-link" href="{{ route('user.setting') }}">
                           <span class="header-icon">
                              <i class="icon icon-setting"></i>
                           </span>
                            </a>

                        </h2>
                    </div>

                </div>
                <div class="profile-container">
                    <div class="profile-main-box">
                        <div class="profile-user-row">

                            <div class="profile-btn-box profile-btn-box-r">
                                <a href="#" class="profile-btn">
                                <span class="btn-box-icon">
                                    <i class="icon icon-money"></i>
                                </span>
                                    {{ $amount }} ریال
                                </a>
                            </div>
                            <div class="profile-user-info">
                                <div class="user-detail-main">
                                    <!--<a href="#" class="profile-image-box">

                                        <img
                                            src="{{ ($loginUser->image!=getConstant('site_url').getUserImagePath('')) ? $loginUser->image : frontendTheme('images/user-photo.png') }}"
                                            alt="{{ $loginUser->name }}">
                                    </a>-->
                                    <h2 class="user-title">{{ $loginUser->name }}</h2>
                                </div>


                            </div>
                            <div class="profile-btn-box profile-btn-box-l">
                                <a href="{{ route('wallet.add') }}" class="profile-btn">
                                <span class="btn-box-icon">
                                <i class="icon icon-plus-cross"></i>
                                </span>
                                    افزایش موجودی
                                </a>
                            </div>
                        </div>
                        <div class="profile-nav-box">
                            <!--<div class="profile-nav-item profile-level">
                                <div class="profile-level-title silver">
                                <span class="level-title">
                                    سطح نقره ای
                                </span>
                                </div>
                                <div class="profile-level-title gold">
                                <span class="level-title">
                                    سطح طلایی
                                </span>
                                </div>
                                <div class="level-process">
                                    <span class="level-process-title">150 متر تا سطح بعدی</span>
                                    <span class="process-line"></span>
                                </div>
                            </div>-->
                            <div class="profile-nav-item">
                                <a href="{{ route('user.edit') }}" class="profile-nav-link">
                                    <span class="link-text">اطلاعات شخصی</span>
                                    <span class="link-icon">
                                    <i class="fal fa-angle-left"></i>
                                </span>
                                </a>
                            </div>
                            <div class="profile-nav-item">
                                <a href="{{ route('order.list') }}" class="profile-nav-link">
                                    <span class="link-text"> @lang('order.list')</span>
                                    <span class="link-icon">
                                    <i class="fal fa-angle-left"></i>
                                </span>
                                </a>
                            </div>
                            <div class="profile-nav-item">
                                <a href="{{ route('userdetail.addresses') }}" class="profile-nav-link">
                                    <span class="link-text">@lang('user_detail.addresess')</span>
                                    <span class="link-icon">
                                    <i class="fal fa-angle-left"></i>
                                </span>
                                </a>
                            </div>
                            <div class="profile-nav-item">
                                <a href="{{ route('bookmark.list') }}" class="profile-nav-link">
                                    <span class="link-text">@lang('bookmark.list') </span>
                                    <span class="link-icon">
                                    <i class="fal fa-angle-left"></i>
                                </span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @else

            @endif
        </div>
        <!-- end profile tab content  -->

        <!-- start new tab content  -->
        <div class="main-tab-content" id="new-tab">
            <div class="main-header">
                @include(currentFrontView('partials.basket_icon'))
                <div class="header-center">
                    <h2 class="header-title">
                        تازه ها
                    </h2>
                </div>
                <div class="header-left">
                    <h2 class="header-title">
                        <a class="header-link" href="{{ route('textile.search_filter') }}">
                           <span class="header-icon">
                              <i class="icon icon-search1" style="visibility: hidden"></i>
                           </span>
                        </a>

                    </h2>
                </div>
            </div>
            <div class="default-full-container">
                <div class="main-new-tab-nav">
                    <nav class="main-new-nav">
                        <li class="new-tab-item"><a href="#man-tab">مردانه</a></li>
                        <li class="new-tab-item"><a href="#woman-tab">زنانه</a></li>
                    </nav>
                </div>
                <!--<div class="new-tab-nav main-new-content" id="new-man">
                    <nav class="new-nav">

                        <li class="new-tab-item"><a href="#man-tab-1">تابستانه</a></li>
                        <li class="new-tab-item"><a href="#man-tab-2">2020</a></li>
                        <li class="new-tab-item"><a href="#man-tab-3">نخی</a></li>
                        <li class="new-tab-item"><a href="#man-tab-4">چهارخونه</a></li>
                        <li class="new-tab-item"><a href="#man-tab-5">پیرآهن</a></li>
                    </nav>
                </div>
                <div class="new-tab-nav main-new-content" id="new-woman">
                    <nav class="new-nav">

                        <li class="new-tab-item"><a href="#woman-tab-1">تابستانه</a></li>
                        <li class="new-tab-item"><a href="#woman-tab-2">2020</a></li>
                        <li class="new-tab-item"><a href="#woman-tab-3">نخی</a></li>
                        <li class="new-tab-item"><a href="#woman-tab-4">چهارخونه</a></li>
                        <li class="new-tab-item"><a href="#woman-tab-5">پیرآهن</a></li>
                    </nav>
                </div>-->
                <!-- man content -->
                <div class="new-tab-content main-new-content" id="man-tab">
                    @foreach ($man_category_trends as $category_trend)
                        <h2 class="new-tab-heading">{{ $category_trend->title }} </h2>
                        @foreach($category_trend->trends as $trend)
                            <div class="tab-columnbox-6">
                                <div class="tab-item-box">
                                    <a href="{{ route('trend.view',[$trend->id,$trend->slug]) }}">
                                        <div class="image-box">
                                            <img src="{{ $trend->thumbnail }}" alt="{{ $trend->title }}">
                                        </div>
                                        <h3 class="new-item-title">{{ $trend->title }} </h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="new-tab-content main-new-content" id="woman-tab">

                    @foreach ($woman_category_trends as $category_trend)
                        <h2 class="new-tab-heading">{{ $category_trend->title }} </h2>
                        @foreach($category_trend->trends as $trend)
                            <div class="tab-columnbox-6">
                                <div class="tab-item-box">
                                    <a href="{{ route('trend.view',[$trend->id,$trend->slug]) }}">
                                        <div class="image-box">
                                            <img src="{{ $trend->thumbnail }}" alt="{{ $trend->title }}">
                                        </div>
                                        <h3 class="new-item-title">{{ $trend->title }} </h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

            </div>
        </div>
        <!-- end new tab content  -->

        <!-- start category tab  -->
        <div class="main-tab-content" id="category-tab">

            <div class="main-header">
                @include(currentFrontView('partials.basket_icon'))
                <div class="header-center">
                    <h2 class="header-title">
                        دسته بندی
                    </h2>
                </div>
                <div class="header-left">
                    <h2 class="header-title">
                        <a class="header-link" href="{{ route('textile.search_filter') }}">
                           <span class="header-icon">
                              <i class="icon icon-search1" style="visibility: hidden"></i>
                           </span>
                        </a>

                    </h2>
                </div>
            </div>

            <div class="default-full-container">

                <div class="category-tab-nav">
                    <nav class="category-nav">
                        <?php
                        $parent_categories = \App\Category::where('parent_id', null)->select('id', 'title', 'slug')->get();
                        ?>
                        @foreach($parent_categories as $parent_category)
                            <li class="category-tab-item"><a
                                    href="#{{ $parent_category->slug }}">{{ $parent_category->title }}</a></li>
                        @endforeach
                    </nav>
                </div>
                @foreach($parent_categories as $parent_category)
                    <?php
                    $childCategories = \App\Category::where('parent_id', $parent_category->id)->get();
                    ?>
                    <div class="category-tab-content" id="{{ $parent_category->slug }}">
                        @foreach($childCategories as $childCategory)
                            <div class="category-item-box column-4">
                                <div class="category-item">
                                    <a href="{{ route('textile.search').'?category_id='.$childCategory->id.',' }}">
                                        <img src="{{getCategoryImagePath($childCategory->thumbnail)}}"
                                             alt="{{$childCategory->title}}"></a>
                                    <a href="{{ route('textile.search').'?category_id='.$childCategory->id }}">{{$childCategory->title}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end category tab -->

        <!-- start bincoulars tab content  -->
        <div class="main-tab-content" id="home-tab">
            <div class="main-header">
                @include(currentFrontView('partials.basket_icon'))
                <div class="header-center">
                    <h2 class="header-title">
                        خانه
                    </h2>
                </div>
                <div class="header-left">
                    <h2 class="header-title">
                        <a class="header-link" href="{{ route('textile.search_filter') }}">
                   <span class="header-icon">
                      <i class="icon icon-search"></i>
                   </span>
                        </a>

                    </h2>
                </div>
            </div>

            <!--<div class="default-full-container">
                <div class="binoculars-top-nav">
                    <a href="#" class="bincoulars-item">اخبار</a>
                    <a href="#" class="bincoulars-item">جستجوی محصول</a>
                </div>
            </div>-->

            <div class="default-full-container">
                <div class="main-slide-show">
                    <div class="scrolling-wrapper">
                        @foreach($discount_banners as $discount_banner)
                            <div class="main-slide-item">
                                <a href="{{ route('textile.search').'?discount_type_id='.$discount_banner->id }}">
                                    <h3 class="image-caption">{{$discount_banner->title}}</h3>
                                    <img src="{{ $discount_banner->thumbnail }}" alt="{{$discount_banner->title}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- trending products section start  -->
            <div class="default-full-container">
                <div class="product-main-box green-main-box">
                    <div class="main-box-header purple-header-main">
                        <a href="{{ route('textile.search').'?newers=1' }}">
                        <h2 class="main-box-title">
                            جدید ترین ها
                        </h2>
                        </a>
                    </div>
                    <div class="scrolling-wrapper">

                        @foreach($newers as $textile)
                            @include(currentFrontView('partials.textiles.last'),['type'=>'new','texttile'=>$textile])
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="default-full-container">
                <div class="main-advertising">
                    @foreach($discount_issingle_banners as $discount_banner)
                        <a href="{{ route('textile.search').'?discount_type_id='.$discount_banner->id }}">
                            <img src="{{ $discount_banner->thumbnail }}" alt="{{$discount_banner->title}}">
                        </a>
                        @break
                    @endforeach
                </div>
            </div>

            <div class="default-full-container">
                <div class="product-main-box yellow-main-box">
                    <div class="main-box-header pink-header-main">
                        <a href="{{ route('textile.search').'?last_discounts=1' }}"><h2 class="main-box-title">تخفیف ها</h2></a>
                    </div>
                    <div class="scrolling-wrapper">
                        @foreach($last_discounts as $textile)
                            @include(currentFrontView('partials.textiles.last'),['type'=>'new','texttile'=>$textile])
                        @endforeach
                    </div>
                </div>
            </div>

            @foreach($discount_issingle_banners as $key => $discount_banner)
                @if ($key==1)
                    <div class="default-full-container">
                        <div class="main-advertising">
                            <a href="{{ route('textile.search').'?discount_type_id='.$discount_banner->id }}">
                                <img src="{{ $discount_banner->thumbnail }}" alt="{{$discount_banner->title}}">
                            </a>
                        </div>
                    </div>
                @break
            @endif
        @endforeach


        <!-- trending products section end  -->
        </div>
        <!-- end bincoulars tab content  -->

        <!-- main tab divider start -->
        <div class="main-tab-divider"></div>
        <!-- start main tab nav  -->
        <div class="main-tab-nav">
            <li class="tab-item home-tab"  >
                <a href="#home-tab" ><span class="tab-icon"><i class="icon icon-home"></i></span>خانه</a>
            </li>
            <li class="tab-item category-tab"  >
                <a href="#category-tab" ><span class="tab-icon"><i class="icon icon-category"></i></span>دسته بندی ها</a>
            </li>
            <li class="tab-item new-tab"  >
                <a href="#new-tab" ><span class="tab-icon"><i class="icon icon-news"></i></span>تازه ها</a>
            </li>
            <li class="tab-item profile-tab"  >
                <a href="#profile-tab" >
                    <span class="tab-icon"><i class="icon icon-user"></i></span>
                    پروفایل
                </a>
            </li>

        </div>
        <!-- end main tab nav -->
        <!-- end main tab section -->


    </main>
    <script src="{{ frontendTheme('js/index.js') }}"></script>

    <script>
        var login = ' {{auth()->check()}} ';
        $('.main-tab-nav .tab-item').click(function () {
            var activeTab = $(this).find('a').attr('href');
            if ("#profile-tab" == activeTab) {
                if (login == 0)
                    window.location = "/login";

            }
        });
    </script>
@endsection
