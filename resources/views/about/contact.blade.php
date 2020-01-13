@extends('layouts.default')

@push('stylesheet')
    <link rel="stylesheet" href="{{ config('theme.cdn_url') }}template/front/2.0.1/vendor/dzsparallaxer/dzsparallaxer.css">
@endpush

@section('content')
    <div class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll"
         data-options='{direction: "normal"}'>
        <div class="divimage dzsparallaxer--target" style="height: 120%; background-image: url({{ config('theme.cdn_url') }}template/front/2.0.1/img/1920x800/img13.jpg);"></div>

        <div class="container position-relative space-2 space-top-md-5 space-bottom-md-3 z-index-2">
            <div class="w-lg-80 text-center mx-auto">
                <h1 class="display-3 font-size-md-down-5 text-white font-weight-semi-bold">Entre em contato</h1>
                <p class="lead text-white">Dúvidas, sugestões, precisa de ajuda? Estamos aqui para atendê-lo.</p>
            </div>
        </div>
    </div>

    <div class="clearfix space-2">
        <div class="row no-gutters">
            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon16" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/icons/icon-16.svg" alt="WhatsApp e Telefone">
                    </figure>

                    <h3 class="h6 mb-0">WhatsApp e Telefone</h3>

                    <a class="mb-0" href="https://wa.me/5531997150447?text=Oi%20tudo%20bem?%20Gostaria%20de%20falar%20sobre%20o%20Tikket" target="_blank">
                        (31) 99715-0447
                    </a>
                </div>
            </div>

            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon15" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/icons/icon-15.svg" alt="E-mail">
                    </figure>

                    <h3 class="h6 mb-0">E-mail</h3>

                    <a href="mailto:contato@quantofica.com">
                        <p class="mb-0">contato@tikket.com.br</p>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon16" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/icons/icon-4.svg" alt="WhatsApp e Telefone">
                    </figure>

                    <h3 class="h6 mb-0">Facebook Messenger</h3>

                    <a class="mb-0" href="https://m.me/tikketeventos" target="_blank">
                        https://m.me/tikketeventos
                    </a>
                </div>
            </div>

            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon8" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/icons/icon-8.svg" alt="Endereço">
                    </figure>

                    <h2 class="h6 mb-0">Endereço</h2>
                    <p class="mb-0">Rua Dr. Milton Bandeira, 346, Edifício Alphaville, Sala 302<br>Centro, Viçosa, MG</p>
                </div>

            </div>
        </div>
    </div>

    <hr class="my-0">
@endsection

@push('defer-scripts')
    <script defer src="{{ config('theme.cdn_url') }}template/front/2.0.1/vendor/dzsparallaxer/dzsparallaxer.js"></script>
@endpush
