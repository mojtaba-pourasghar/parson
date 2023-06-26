<!DOCTYPE html>
<html>
<head>

    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')">
    <meta name="copyright" content="https://www.kethub.com/"/>
    <meta name="robots" content="index, follow"/>
    <meta name="HandheldFriendly" content="true"/>

@yield('open_graph')
<!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{ frontendTheme('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/brands.min.css') }}">

    <link rel="stylesheet" href="{{ frontendTheme('css/light.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('js/timer/jquery.classycountdown.min.css') }}">

    <link rel="stylesheet" href="{{ frontendTheme('css/style.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ frontendTheme('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ frontendTheme('images/favicon//favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ frontendTheme('images/favicon//favicon-16x16.png') }}">
    <link rel="manifest" href="{{ frontendTheme('images/favicon//site.webmanifest') }}">

    <script src="{{ frontendTheme('js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ frontendTheme('css/toastr/toastr.min.css') }}">
    <script src="{{ frontendTheme('js/toastr/toastr.min.js') }}"></script>
    <script src="{{ frontendTheme('js/bootstrap.min.js') }}"></script>
    <script>
        var config = {
            routes: {
                refresh_basket_url: "{{ route("basket.refresh") }}",
                add_to_basket_url: "{{ route("basket.add") }}",
            },
            token : '{{ csrf_token() }}'
        };
    </script>
    <script src="{{ frontendTheme('js/global.js') }}"></script>
    <link rel="stylesheet" href="{{ frontendTheme('css/jquery.loadingModal.min.css') }}">
    <script src="{{ frontendTheme('js/jquery.loadingModal.min.js') }}"></script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NG8X7ZS');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NG8X7ZS"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header>
    <div class="header-line-bar">
        <div class="header-line-right">
            <h1 class="line-bar-title">
                <a href="{{ route('home') }}">
                 <span class="shop-icon">
                     <i class="icon-shop"></i>
                 </span>
                    فروشگاه آنلاین پارچه پرسون
                </a>
            </h1>
        </div>
        <div class="header-line-left">
            <ul class="header-line-nav">
                <li class="line-nav-item"><a href="/service">خدمات مشتریان</a></li>
                <li class="line-nav-item"><a href="/about">درباره ما</a></li>
                <li class="line-nav-item"><a href="/contactus">تماس با ما</a></li>
            </ul>
        </div>
    </div>
    <div class="main-header">
        <div class="header-user-section">
            <a href="{{ route("basket.list") }}" class="user-shoping-box">
                <span class="shoping-basket">
                    <i class="icon-basket"></i>
                    <span class="number-basket " id="header_basket">0</span>
                </span>
                سبد خرید
            </a>
            @if(auth()->check())
                <a href="{{ route('user.edit') }}" class="user-account-box">
                <span class="user-account-icon">
                    <i class="icon icon-profile-edit"></i>
                </span>
                    ویرایش حساب
                </a>
            @else
                <a href="{{ route('login') }}" class="user-account-box">
                <span class="user-account-icon">
                    <i class="icon-user"></i>
                </span>
                    حساب کاربری
                </a>
            @endif

        </div>
        <div class="header-main-section">
            <div class="logo-box">
                <img src="{{ frontendTheme('images/logo.png') }}" alt="logo">
            </div>
            <div class="search-box">
                {!! Form::model('', ['route' => ['textile.search'],'method' => 'get','id'=>'search_form'] ) !!}
                    <input type="text" name="title" value="{{ (!empty($_REQUEST['title'] )) ? $_REQUEST['title'] : '' }}" class="search-input" placeholder="محصول مورد نظرتان را جستجو کنید">
                    <div class="search-icon-box" id="search_btn">
                        <span class="search-icon">
                            <i class="icon icon-search"></i>
                        </span>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        $('#search_btn').click(function () {
            $('#search_form').submit();
        });
    </script>
    <!-- main navigation -->
    <div class="navigation-section">
        <div class="navbar-box">
            <ul class="navbar-nav">
                <li class="navbar-item active">
                    <span class="nav-item-icon">
                        <i class="icon icon-home"></i>
                    </span>
                    <a href="{{ route('home') }}">
                        صفحه نخست
                    </a>
                </li>
                <li class="navbar-item dropdown mega-dropdown">
                    <span class="nav-item-icon">
                        <i class="icon icon-menu-burger"></i>
                     </span>
                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navbarDropdown"
                       role="button" class="mega-toggle">
                        دسته بندی ها
                        <span class="dropdown-icon"> <i class="fal fa-chevron-down"></i></span>
                    </a>


                    <ul class="dropdown-menu mega-menu" aria-labelledy="navbarDropdown">
                        <span class="mega-top-border"></span>
                        <div class="dropdown-main-section">

                            <?php
                            $categories = \App\Category::where('parent_id', NULL)->get();
                            ?>
                            @foreach($categories as $category)
                                <div class="dropdown-column column-3">
                                    <li class="column-nav-header">
                                        <a href="{{ route('textile.search').'?category_id='.$category->id }}">
                                            <span class="nav-header-icon">
                                                <i class="fas fa-circle"></i>
                                            </span>
                                            {{$category->title }}
                                        </a>
                                    </li>
                                    <ul class="dropdown-column-nav column-6">
                                        <?php
                                        $childCategories = \App\Category::where('parent_id', $category->id)->get();
                                        ?>
                                        @foreach($childCategories as $childCategory)
                                            <li class="dropdown-column-item">
                                                <a href="{{ route('textile.search').'?category_id='.$childCategory->id.',' }}">
                                                    <span class="column-item-icon">
                                                        <i class="fas fa-circle"></i>
                                                    </span>
                                                    {{$childCategory->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul class="dropdown-column-nav column-6"></ul>
                                </div>
                            @endforeach
                        </div>
                    </ul>
                </li>
                <li class="navbar-item dropdown mega-dropdown">
                    <span class="nav-item-icon">
                        <i class="icon icon-new"></i>
                    </span>
                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navbarDropdown"
                       role="button" class="mega-toggle">
                        تازه ها
                        <span class="dropdown-icon"> <i class="fal fa-chevron-down"></i></span>
                    </a>
                    <ul class="dropdown-menu mega-menu" aria-labelledy="navbarDropdown">
                        <span class="mega-top-border"></span>
                        <div class="dropdown-main-section">
                            <div class="dropdown-column column-3">
                                <li class="column-nav-header">
                                    <a href="{{ route('trend.last',[1,0]) }}">
                                    <span class="nav-header-icon">
                                        <i class="fas fa-circle"></i>
                                    </span>
                                        اقایان
                                    </a>
                                </li>
                            </div>
                            <div class="dropdown-column column-3">
                                <li class="column-nav-header">
                                    <a href="{{ route('trend.last',[0,0]) }}">
                                      <span class="nav-header-icon">
                                          <i class="fas fa-circle"></i>
                                      </span>
                                        بانوان
                                    </a>
                                </li>

                            </div>

                        </div>
                    </ul>
                </li>
                <!--<li class="navbar-item">
                    <span class="nav-item-icon">
                        <i class="icon icon-news"></i>
                    </span>
                    <a href="#">
                        اخبار
                    </a>
                </li>-->
            </ul>
        </div>
        <div class="user-admin-box">

            @if(auth()->check())
                <a href="{{ route('auth.logout') }}" class="user-admin">
                <span class="login-icon">
                    <i class="icon icon-sign-out"></i>
                </span>
                    @lang('message.exit')
                </a>
            @else
                <a href="{{ route('login') }}" class="user-admin">
                <span class="login-icon">
                    <i class="icon icon-login"></i>
                </span>
                    ورود به حساب
                </a>
            @endif
        </div>
    </div>
    <!-- end main navigation  -->

</header>

<div class="col-md-5" style="margin: auto">

</div>

@yield('content')


@include('partials.footer')
<script>
    __the_operation_failed = '{{ __('message.the_operation_failed') }}';
</script>

<script src="{{ frontendTheme('js/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ frontendTheme('js/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ frontendTheme('js/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ frontendTheme('js/timer/jquery.classycountdown.min.js') }}"></script>
<script src="{{ frontendTheme('js/timer/jquery.knob.js') }}"></script>
<script src="{{ frontendTheme('js/timer/jquery.throttle.js') }}"></script>
<script src="{{ frontendTheme('js/index.js') }}"></script>
<script src="{{ frontendTheme('js/alert.js') }}"></script>
<script src="{{ frontendTheme('js/main.js') }}"></script>

</body>
</html>
