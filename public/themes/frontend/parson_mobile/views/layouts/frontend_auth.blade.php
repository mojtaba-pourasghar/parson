<!DOCTYPE html>
<html>
@include('partials.head')
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
