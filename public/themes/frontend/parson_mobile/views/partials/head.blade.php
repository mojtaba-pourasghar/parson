<head>

    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')">
    <meta name="copyright" content="https://parsontex.com/"/>
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


    <link rel="stylesheet" href="{{ frontendTheme('css/style.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ frontendTheme('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ frontendTheme('images/favicon//favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ frontendTheme('images/favicon//favicon-16x16.png') }}">
    <link rel="manifest" href="{{ frontendTheme('images/favicon//site.webmanifest') }}">

    <script src="{{ frontendTheme('js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ frontendTheme('css/toastr/toastr.min.css') }}">
    <script src="{{ frontendTheme('js/toastr/toastr.min.js') }}"></script>
    <script src="{{ frontendTheme('js/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" href="{{ frontendTheme('js/mfb/mfb.css') }}">
    <script src="{{ frontendTheme('js/mfb/lib/modernizr.touch.js') }}"></script>


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

<span class="home-button">
    <a href="{{ route('home') }}">
        <span class="home-btn-icon"><i class="icon icon-home"></i></span>
    </a>
</span>
