<div class="position-relative gradient-half-warning-v1">
    <div class="container position-relative z-index-2">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex align-items-center space-2 min-height-380 pr-lg-7">
                    <div class="d-block">
                        <h2 class="text-white">Possui um evento?</h2>
                        <p class="text-white-70 mb-4">Utilize o Tikket, a forma mais simples de vender ingressos online.</p>
                        <a class="btn btn-outline-info btn-wide transition-3d-hover" href="{{ config('app.domains.admin') }}/evento/novo-evento">Publicar evento</a>
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
