<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ backendTheme('css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ backendTheme('css/bootstrap.rtl.min.css') }} " rel="stylesheet">
    <link href="{{ backendTheme('font-awesome/css/font-awesome.css') }} " rel="stylesheet">
    <link href="{{ backendTheme('css/animate.css') }} " rel="stylesheet">
    <link href="{{ backendTheme('css/style.rtl.css') }} " rel="stylesheet">
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h4 class="logo-name">پرسون</h4>
        </div>
        <h3>@yield('heading')</h3>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                @foreach($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif
        @if ($status)
            <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ $status }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

<script src="{{ backendTheme('js/jquery-2.1.1.js') }} "></script>
<script src="{{ backendTheme('js/bootstrap.min.js') }} "></script>
</body>
</html>
