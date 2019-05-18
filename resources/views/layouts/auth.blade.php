<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @if(config('app.env') === 'production')
        @include('layouts.components.analytics')
    @endif

    <meta charset="UTF-8">

    <title>{{ \Meta::get('title') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    {!! \Meta::tags() !!}
    <meta name="csrf-token" content="{{csrf_token()}}">
    {!! \Meta::tag('csrf-token', csrf_token()) !!}

    <link rel="shortcut icon" href="{{ config('theme.cdn_url') }}images/tikket/icon.png">
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

    <script defer src="{{ config('theme.cdn_url') }}vendor/pace/1.0.2/pace.min.js"></script>
    <link href="{{ config('theme.cdn_url') }}vendor/pace/1.0.2/pace-theme-flash.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ config('theme.cdn_url') }}template/front/2.1.1/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="{{ config('theme.cdn_url') }}template/front/2.1.1/vendor/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="{{ config('theme.cdn_url') }}template/front/2.1.1/css/theme-purple.min.css">

    @stack('stylesheet')
</head>
<body>

@include('auth.header')

<a id="skippy" class="sr-only sr-only-focusable u-skippy" href="#content">
    <div class="container">
        <span class="u-skiplink-text">Pular para o conteúdo principal</span>
    </div>
</a>

<main id="content" role="main">
    <div class="d-flex align-items-center position-relative height-lg-100vh">

        @include('auth.aside')

        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-8 col-lg-7 col-xl-6 offset-md-2 offset-lg-2 offset-xl-3 space-3 space-lg-0">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</main>
<script src="{{ config('theme.cdn_url') }}template/front/2.0.2/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ config('theme.cdn_url') }}template/front/2.0.2/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="{{ config('theme.cdn_url') }}template/front/2.0.2/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="{{ config('theme.cdn_url') }}template/front/2.0.2/vendor/bootstrap/bootstrap.min.js"></script>

<script src="{{ config('theme.cdn_url') }}template/front/2.0.2/vendor/slick-carousel/slick/slick.js"></script>

<script src="{{ config('theme.cdn_url') }}template/front/2.0.2/js/theme.min.js"></script>
<script src="{{ config('theme.cdn_url') }}template/front/2.0.2/vendor/slick-carousel/slick/slick.min.js"></script>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>


@routes()

@stack('scripts')

<script>
    $(document).on('ready', function () {
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        @stack('onready')
    });
</script>

</body>
</html>
