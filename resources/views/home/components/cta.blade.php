{{--<div class="position-relative bg-primary text-white text-center z-index-2 overflow-hidden">
    <div class="container space-2">
        <h3 class="h2 font-weight-semi-bold mb-3">Pronto para começar?</h3>
        <p class="lead text-white mb-5">
            <span class="font-weight-semi-bold">Tikket</span> – a forma mais simples de vender ingressos online.
        </p>

        <a class="btn btn-info text-white btn-wide transition-3d-hover" href="#">Publicar evento</a>
    </div>

    <figure class="position-absolute top-0 left-0 w-100 max-width-27 z-index-n1">
        <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/components/abstract-shapes-8.svg" alt="Image Description">
    </figure>

    <figure class="position-absolute bottom-0 right-0 w-100 max-width-27 z-index-n1">
        <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/components/abstract-shapes-5.svg" alt="Image Description">
    </figure>
</div>--}}

<div class="position-relative gradient-half-warning-v1">
    <div class="container position-relative z-index-2">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex align-items-center space-2 min-height-380 pr-lg-7">
                    <div class="d-block">
                        <h2 class="text-white">Possui um evento?</h2>
                        <p class="text-white-70 mb-4">Utilize o Tikket, a forma mais simples de vender ingressos online.</p>
                        <a class="btn btn-outline-info btn-wide transition-3d-hover" href="{{ route('new-event') }}">Publicar evento</a>
                    </div>
                </div>

                <figure class="w-50 position-absolute right-0 bottom-0 mr-7">
                    <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/illustrations/building-site.svg" alt="SVG Illustration">
                </figure>
            </div>

            <div class="col-lg-6">
                <div class="d-flex align-items-center space-2 min-height-380 pl-lg-7">
                    <div class="d-block">
                        <h2 class="text-white">Entre em contato</h2>
                        <p class="text-white-70 mb-4">Se você quiser saber mais sobre como podemos ajudá-lo, ligue para nós ou nos envie um e-mail.</p>
                        <a class="btn btn-outline-primary btn-wide transition-3d-hover" href="{{ route('contact') }}">Contatos</a>
                    </div>
                </div>

                <figure class="w-50 position-absolute right-0 bottom-0">
                    <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/illustrations/pushing-boundaries.svg" alt="SVG Illustration">
                </figure>
            </div>
        </div>
    </div>

    <div class="col-lg-6 gradient-half-primary-v1 position-absolute top-0 left-0 min-height-380"></div>
</div>
