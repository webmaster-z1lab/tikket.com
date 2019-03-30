@extends('layouts.default')

@push('stylesheet')
    <link rel="stylesheet" href="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/vendor/dzsparallaxer/dzsparallaxer.css">
@endpush

@section('content')
    <div class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll"
         data-options='{direction: "normal"}'>
        <div class="divimage dzsparallaxer--target" style="height: 120%; background-image: url({{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/img/1920x800/img13.jpg);"></div>

        <div class="container position-relative space-2 space-top-md-5 space-bottom-md-3 z-index-2">
            <div class="w-lg-80 text-center mx-auto">
                <h1 class="display-3 font-size-md-down-5 text-white font-weight-semi-bold">Entre em contato</h1>
                <p class="lead text-white">Dúvidas, sugestões, precisa de ajuda? Estamos aqui para atendê-lo</p>
            </div>
        </div>
    </div>

    <div class="clearfix space-2">
        <div class="row no-gutters">
            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon4" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/icons/icon-4.svg" alt="Atendimento Online">
                    </figure>

                    <h2 class="h6 mb-0">Atendimento Online</h2>

                    <a class="mb-0" href="https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default" target="_blank">Acessar chat (link externo)</a>
                </div>
            </div>

            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon16" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/icons/icon-16.svg" alt="WhatsApp e Telefone">
                    </figure>

                    <h3 class="h6 mb-0">WhatsApp e Telefone</h3>

                    <a class="mb-0" href="https://wa.me/5531997150447?text=Oi%20tudo%20bem?%20Gostaria%20de%20falar%20sobre%20o%20Tikket" target="_blank">
                        (31) 99715-0447
                    </a>
                </div>
            </div>

            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon8" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/icons/icon-8.svg" alt="Endereço">
                    </figure>

                    <h2 class="h6 mb-0">Endereço</h2>
                    <p class="mb-0">Av. Santa Rita, 481, Apto. 201,<br>Centro, Viçosa, MG</p>
                </div>

            </div>

            <div class="col-lg-6 u-ver-divider u-ver-divider--none-lg">
                <div class="text-center py-5">
                    <figure id="icon15" class="ie-height-56 max-width-8 mx-auto mb-3">
                        <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/icons/icon-15.svg" alt="E-mail">
                    </figure>

                    <h3 class="h6 mb-0">E-mail</h3>

                    <a href="mailto:contato@quantofica.com">
                        <p class="mb-0">contato@tikket.com.br</p>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <hr class="my-0">

    {{--<div class="container space-2 space-md-3">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
            <span class="u-label u-label--sm u-label--success mb-2">Deixe sua mensagem</span>
            <h2 class="text-primary font-weight-normal">Conte-nos sobre <span class="font-weight-semi-bold">você</span></h2>
            <p>Se você tiver dúvidas ou quiser apenas nos cumprimentar, entre em contato.</p>
        </div>

        <div class="w-lg-80 mx-auto">
            <form id="contact">
                <div class="row">
                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            <label class="form-label" for="name">Seu nome<span class="text-danger">*</span></label>

                            <input class="form-control" name="name" placeholder="Seu nome" aria-label="Seu nome" id="name" required>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-6">
                        <div class="js-form-message">
                            <label class="form-label" for="email">Seu e-mail<span class="text-danger">*</span></label>

                            <input type="email" class="form-control" name="email" id="email" placeholder="Seu e-mail" aria-label="Seu e-mail" required>
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm-6 mb-6">
                        <div class="form-group">
                            <label class="form-label" for="subject">Assunto<span class="text-danger">*</span></label>

                            <input class="form-control" name="subject" id="subject" placeholder="Assunto" aria-label="Assunto" required>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-6">
                        <div class="form-group">
                            <label class="form-label" for="phone">Seu telefone<span class="text-danger">*</span></label>

                            <input class="form-control" name="phone" id="phone" placeholder="Seu telefone" aria-label="Seu telefone" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-6">
                    <label class="form-label" for="message">Como podemos ajudá-lo?<span class="text-danger">*</span></label>

                    <textarea class="form-control" rows="4" name="text" id="message" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-wide transition-3d-hover mb-4">Enviar</button>
                    <p class="small">Retornaremos o mais breve possível.</p>
                </div>
            </form>

        </div>
    </div>--}}
@endsection

@push('defer-scripts')
    <script defer src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/vendor/dzsparallaxer/dzsparallaxer.js"></script>
@endpush
