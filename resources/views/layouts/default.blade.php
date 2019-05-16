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
    {!! \Meta::tag('csrf-token', csrf_token()) !!}

    <link rel="shortcut icon" href="{{ config('theme.cdn_url') }}images/tikket/icon-xs.png">

    <script defer src="{{ config('theme.cdn_url') }}vendor/pace/1.0.2/pace.min.js"></script>
    <link href="{{ config('theme.cdn_url') }}vendor/pace/1.0.2/pace-theme-flash.css" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    @foreach(config('theme.css') as $item)
        <link rel="stylesheet" href="{{ config('theme.cdn_url') . config('theme.prod.namespace') . config('theme.prod.version') . "/$item" }}">
    @endforeach

    @stack('stylesheet')

    @foreach(config('theme.js-defer') as $item)
        <script defer src="{{ config('theme.cdn_url') . config('theme.prod.namespace') . config('theme.prod.version') . "/$item" }}"></script>
    @endforeach

    @stack('defer-scripts')

    <script defer src="{{ mix('js/sidebar/main.js') }}"></script>
</head>
<body>

@stack('after-body-scripts')

<a id="skippy" class="sr-only sr-only-focusable u-skippy" href="#content">
    <div class="container">
        <span class="u-skiplink-text">Pular para o conteúdo principal</span>
    </div>
</a>

@include('layouts.components.header')

<main id="content" role="main">
    @yield('content')
</main>

@include('layouts.components.footer')

<div id="vue-sidebar"></div>

<a class="js-go-to u-go-to" href="#"
   data-position='{"bottom": 15, "right": 15 }'
   data-type="fixed"
   data-offset-top="400"
   data-compensation="#header"
   data-show-effect="slideInUp"
   data-hide-effect="slideOutDown">
    <span class="fa fa-arrow-up u-go-to__inner"></span>
</a>

@foreach(config('theme.js') as $value)
    <script src="{{ config('theme.cdn_url') . config('theme.prod.namespace') . config('theme.prod.version') . "/$value" }}"></script>
@endforeach

@routes()

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>

@stack('scripts')

<script>
    $(window).on('load', function () {
        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 767,
            hideTimeOut: 0
        });

        // initialization of HSMegaMenu component
        $('.js-breadcrumb-menu').HSMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 991,
            hideTimeOut: 0
        });
    });

    $(document).on('ready', function () {
        $.HSCore.components.HSHeader.init($('#header'));
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');
        //$.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));
        $.HSCore.components.HSGoTo.init('.js-go-to');
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            afterOpen: function () {
                $(this).find('input[type="search"]').focus();
            }
        });

        @stack('onready')
    });
</script>

</body>
</html>
