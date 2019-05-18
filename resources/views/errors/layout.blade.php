<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <title>@yield('title') | tikket.com</title>

    <meta charset="utf-8">

    <meta name="robots" content="no-index, no-follow">
    <meta name="author" content="z1lab.com.br">
    <meta name="locale" content="pt-BR">
    <meta name="theme-color" content="#6FBA00">
    <meta name="site_name" content="tikket.com">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ config('theme.cdn_url') }}images/tikket/icon.png">
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ config('theme.cdn_url') }}template/front/2.1.1/css/theme-purple.min.css">
</head>

<body class="@yield('body-class')" style="@yield('body-style')">

<header id="header" class="u-header u-header--bg-transparent u-header--abs-top">
    <div class="u-header__section">
        <div id="logoAndNav" class="container">
            <nav class="navbar navbar-expand u-header__navbar">
                <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ route('home') }}" aria-label="Front">
                    <img src="{{ config('theme.cdn_url') }}images/tikket/logo.svg" alt="Logo Tikket">
                </a>

                <div class="ml-auto">
                    <a href="//z1lab.com.br" target="_blank">
                        <img src="{{ config('theme.cdn_url') }}images/z1lab/logo/powered_by_black.svg" alt="Z1Lab" width="175px">
                    </a>
                </div>
            </nav>
        </div>
    </div>
</header>

<main id="content" role="main">
    @yield('content')
</main>

<footer class="position-md-absolute right-md-0 bottom-md-0 left-md-0">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center space-1">

            <p class="small text-muted mb-0">&copy; Tikket. Z1Lab {{ date('Y') }}.</p>

            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="//facebook.com/tikketeventos" target="_blank">
                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="//instagram.com/tikketeventos" target="_blank">
                        <span class="fab fa-instagram btn-icon__inner"></span>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a class="btn btn-sm btn-icon btn-soft-secondary btn-bg-transparent" href="//z1lab.com.br" target="_blank">
                        <span class="fas fa-jedi btn-icon__inner" style="color: #6FBA00"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>
