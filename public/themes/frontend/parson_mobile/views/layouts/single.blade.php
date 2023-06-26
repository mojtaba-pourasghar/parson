<!DOCTYPE html>
<html>
@include('partials.head')

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
