<!DOCTYPE html>
<html>
@include('partials.head')
<header>
    <div class="main-header header-two">
        <div class="header-right">
            @if ($has_basket)
                <h2 class="header-title">
                    <a class="header-link" href="{{ route("basket.list") }}">
                    <span class="header-icon">
                        <i class="icon icon-shopping-cart"></i>
                        <span class="number-basket header_basket" id="header_basket">0</span>
                    </span>
                    </a>

                </h2>
            @endif
        </div>
        <div class="header-center">
            <h2 class="header-title">@yield('header_title')</h2>
        </div>
        <div class="header-left">
            <h2 class="header-title">
                <a class="header-link" href="@yield('back_url')">

                       <span class="header-icon">
                        <i class="fal fa-angle-left"></i>
                       </span>
                </a>

            </h2>
        </div>

    </div>
</header>
@yield('content')



<script>
    __the_operation_failed = '{{ __('message.the_operation_failed') }}';
</script>

<script src="{{ frontendTheme('js/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ frontendTheme('js/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ frontendTheme('js/swiper/swiper-bundle.min.js') }}"></script>


<script src="{{ frontendTheme('js/alert.js') }}"></script>
<script src="{{ frontendTheme('js/main.js') }}"></script>

</body>
</html>
