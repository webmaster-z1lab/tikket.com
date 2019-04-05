<div class="bg-primary d-print-none">
    <div class="container space-top-1 pb-3">
        <div class="row">
            <div class="col-lg-5 order-lg-2 text-lg-right mb-4 mb-lg-0">
                <div class="d-flex d-lg-inline-block justify-content-between justify-content-lg-end align-items-center align-items-lg-start">
                    <ol class="breadcrumb breadcrumb-white breadcrumb-no-gutter mb-0">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <span class="breadcrumb-item active" aria-current="page">{{ $page }}</span>
                        </li>
                    </ol>

                    <div class="d-lg-none">
                        <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--white"
                                aria-label="Toggle navigation"
                                aria-expanded="false"
                                aria-controls="breadcrumbNavBar"
                                data-toggle="collapse"
                                data-target="#breadcrumbNavBar">
                                <span id="breadcrumbHamburgerTrigger" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 order-lg-1">
                <div class="row">
                    <div class="col-3 col-md-2">
                        <div class="media d-block d-sm-flex align-items-sm-center">
                            <div class="u-lg-avatar position-relative mb-3 mb-sm-0 mr-3">
                                <img class="img-fluid rounded-circle" src="{{ \Auth::user()->avatar }}" alt="Avatar {{ \Auth::user()->name }}">

                                @if(\Auth::user()->email_verified)
                                    <span class="badge badge-md badge-outline-success badge-pos badge-pos--bottom-right rounded-circle" v-if="user.email_verified">
                                        <span class="fas fa-check"></span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-9 col-md-10">
                        <div class="media-body">
                            <h1 class="h3 text-white font-weight-medium mb-1">{{ \Auth::user()->name }}</h1>
                            <span class="d-block text-white text-truncate">{{ \Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container space-bottom-1 space-bottom-lg-0">
        <div class="d-lg-flex justify-content-lg-between align-items-lg-center">

            <div class="u-header u-header-left-aligned-nav u-header--bg-transparent-lg u-header--white-nav-links z-index-4">
                <div class="u-header__section bg-transparent">
                    <nav class="js-breadcrumb-menu navbar navbar-expand-lg u-header__navbar u-header__navbar--no-space">
                        <div id="breadcrumbNavBar" class="collapse navbar-collapse u-header__navbar-collapse">
                            <ul class="navbar-nav u-header__navbar-nav">
                                 <li class="nav-item u-header__nav-item">
                                    <a href="{{ route('orders') }}" class="nav-link u-header__nav-link">
                                        Meus Pedidos
                                    </a>
                                </li>

                                <li class="nav-item u-header__nav-item">
                                    <a href="{{ route('tickets') }}" class="nav-link u-header__nav-link">
                                        Meus Ingressos
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
