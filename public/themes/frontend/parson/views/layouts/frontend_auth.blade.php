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
    <link rel="stylesheet" href="{{ frontendTheme('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ frontendTheme('css/style.css') }}">
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
    <div class="top-main-header">
        <div class="main-header container  justify-content-center">
            <div class="main-logo col-12 justify-content-center">
                <div class="logo"><a href="{{ route('home') }}"><img src="{{ frontendTheme('images/logo.png') }}"
                                                                     alt="logo"></a></div>
            </div>
        </div>
    </div>

</header>
<div class="col-md-5" style="margin: auto">
    @include('partials.flash-message')
</div>

@yield('content')
@include('partials.footer')
<script src="{{ frontendTheme('js/jquery.min.js') }}"></script>
<script src="{{ frontendTheme('js/popper.min.js') }}"></script>
<script src="{{ frontendTheme('js/bootstrap.min.js') }}"></script>
<script src="{{ frontendTheme('js/lib/visible.js') }}"></script>
<script src="{{ frontendTheme('js/lib/form.js') }}"></script>
<script src="{{ frontendTheme('js/lib/alert.js') }}"></script>
</body>
</html>
