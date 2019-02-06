<header id="header" class="u-header u-header--abs-top-md u-header--bg-transparent u-header--show-hide-md" data-header-fix-moment="500" data-header-fix-effect="slide">
    <div class="u-header__section">
        <div id="logoAndNav" class="container">
            <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{ route('home') }}" aria-label="Front">
                    <span class="u-header__navbar-brand-text"><i class="fas fa-ticket-alt mr-1"></i>Tikket</span>
                </a>

                <div>
                    <button class="btn btn-xs btn-primary ml-0 d-inline d-sm-none mr-2 mr-sm-2"
                            aria-controls="sidebarContent"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInRight"
                            data-unfold-animation-out="fadeOutRight"
                            data-unfold-duration="500">
                        @auth
                            <i class="fas fa-user-circle mr-1"></i>{{ explode(' ', Auth::user()->name)[0] }}
                        @endauth

                        @guest
                            <i class="fas fa-sign-in-alt mr-1"></i>Acessar
                        @endguest
                    </button>

                    <button type="button" class="navbar-toggler btn u-hamburger"
                            aria-label="Toggle navigation"
                            aria-expanded="false"
                            aria-controls="navBar"
                            data-toggle="collapse"
                            data-target="#navBar">
                        <span id="hamburgerTrigger" class="u-hamburger__box">
                            <span class="u-hamburger__inner"></span>
                        </span>
                    </button>
                </div>

                <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                    <ul class="navbar-nav u-header__navbar-nav">
                        <li class="nav-item u-header__nav-item @if(starts_with('home', Route::currentRouteName())) active @endif">
                            @if(starts_with('home', Route::currentRouteName()))
                                <a class="nav-link u-header__nav-link" href="#homeSection">Home</a>
                            @else
                                <a class="nav-link u-header__nav-link" href="{{ route('home') }}">Home</a>
                            @endif
                        </li>

                        <li class="nav-item hs-has-sub-menu u-header__nav-item"
                            data-event="hover"
                            data-animation-in="slideInUp"
                            data-animation-out="fadeOut"
                            data-position="left">
                            <a id="aboutMegaMenu" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="aboutSubMenu">O Tikket</a>

                            <ul id="aboutSubMenu" class="hs-sub-menu u-header__sub-menu u-header__sub-menu--spacer" aria-labelledby="aboutMegaMenu" style="min-width: 230px;">
                                <li><a class="nav-link u-header__sub-menu-nav-link" href="{{ route('about') }}">A empresa</a></li>
                                <li><a class="nav-link u-header__sub-menu-nav-link" href="{{ route('terms') }}">Termos de Uso</a></li>
                                <li><a class="nav-link u-header__sub-menu-nav-link" href="{{ route('privacy') }}">Privacidade e Cookies</a></li>
                            </ul>
                        </li>

                        <li class="nav-item u-header__nav-item">
                            <a class="nav-link u-header__nav-link" href="{{ route('features') }}">Facilidades</a>
                        </li>

                        @auth
                            @include('layouts.components.header.auth')
                        @endauth

                        @guest
                            @include('layouts.components.header.guest')
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
