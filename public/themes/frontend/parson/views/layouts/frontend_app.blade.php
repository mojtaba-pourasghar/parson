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
</head>
<body>


<div class="col-md-5" style="margin: auto">

</div>

@yield('content')


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
