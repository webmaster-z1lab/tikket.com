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

    <link rel="shortcut icon" href="{{ getenv('AWS_CDN_ENDPOINT') }}/images/tikket/ticket_gradient.png">

    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    @foreach(config('theme.css') as $item)
        <link rel="stylesheet" href="{{ config('theme.cdn_url') . config('theme.prod.namespace') . config('theme.prod.version') . "/$item" }}">
    @endforeach

    @foreach(config('theme.js-defer') as $item)
        <script defer src="{{ config('theme.cdn_url') . config('theme.prod.namespace') . config('theme.prod.version') . "/$item" }}"></script>
    @endforeach
</head>
<body>
<header id="header" class="u-header u-header--bg-transparent u-header--abs-top">
    <div class="u-header__section">
        <div id="logoAndNav" class="container">
            <nav class="navbar navbar-expand u-header__navbar">
                <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ route('home') }}" aria-label="Tikket">
                    <span class="u-header__navbar-brand-text"><i class="fas fa-ticket-alt mr-1"></i>Tikket</span>
                </a>
            </nav>
        </div>
    </div>
</header>

<main id="content" role="main">
    <div class="d-lg-flex">
        <div class="container d-lg-flex align-items-lg-center height-lg-100vh space-bottom-1 space-top-3 space-bottom-lg-3 space-lg-0">
            <div class="row align-items-lg-center w-100 mt-lg-9">
                <div class="col-lg-6 mb-7 mb-lg-0">
                    <figure class="ie-virtual-reality">
                        <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/images/undraw/purple/undraw_developer_activity.svg" alt="Image Description" width="100%">
                    </figure>
                </div>

                <div class="col-lg-6">
                    <div class="pl-lg-4">
                        <div class="mb-4">
                            <h1 class="text-primary font-weight-normal">Estaremos prontos <span class="font-weight-semi-bold">em breve</span>.</h1>
                            <p>Nossa plataforma está em construção. Estamos desenvolvendo a melhor solução para o seu evento. Entre em contato com a gente caso queira mais informações.</p>
                        </div>

                        <div class="js-countdown row mb-5"
                             data-end-date="2019/02/29"
                             data-month-format="%m"
                             data-days-format="%D"
                             data-hours-format="%H"
                             data-minutes-format="%M"
                             data-seconds-format="%S">
                            <div class="col-3">
                                <strong class="js-cd-days h3 text-primary font-weight-semi-bold mb-0"></strong>
                                <span class="h5 font-weight-normal mb-0">Dias</span>
                            </div>
                            <div class="col-3">
                                <strong class="js-cd-hours h3 text-primary font-weight-semi-bold mb-0"></strong>
                                <span class="h5 font-weight-normal mb-0">Horas</span>
                            </div>
                            <div class="col-3">
                                <strong class="js-cd-minutes h3 text-primary font-weight-semi-bold mb-0"></strong>
                                <span class="h5 font-weight-normal mb-0">Mins</span>
                            </div>
                            <div class="col-3">
                                <strong class="js-cd-seconds h3 text-primary font-weight-semi-bold mb-0"></strong>
                                <span class="h5 font-weight-normal mb-0">Segs</span>
                            </div>
                        </div>

                        <a class="btn btn-wide btn-primary" href="{{ route('contact') }}">Entrar em contato</a>
                        <a class="btn btn-wide btn-warning" href="{{ route('home') }}">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="position-lg-absolute right-lg-0 bottom-lg-0 left-lg-0">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center space-1">
            <p class="small text-muted mb-0">&copy; Tikket. {{ date('Y') }} Z1Lab.</p>

            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="//www.facebook.com/tikketeventos/" target="_blank">
                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="//www.instagram.com/tikketeventos/" target="_blank">
                        <span class="fab fa-instagram btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="#" target="_blank">
                        <span class="fas fa-jedi btn-icon__inner" style="color: #6FBA00"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>

@foreach(config('theme.js') as $value)
    <script src="{{ config('theme.cdn_url') . config('theme.prod.namespace') . config('theme.prod.version') . "/$value" }}"></script>
@endforeach

<script src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.1.1/vendor/jquery.countdown.min.js"></script>
<script src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.1.1/js/components/hs.countdown.js"></script>

<script>
    $(document).on('ready', function () {
        var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
            yearsElSelector: '.js-cd-years',
            daysElSelector: '.js-cd-days',
            hoursElSelector: '.js-cd-hours',
            minutesElSelector: '.js-cd-minutes',
            secondsElSelector: '.js-cd-seconds'
        });
    });
</script>

</body>
</html>
