@extends('layouts.default')

@section('content')
    <div class="position-relative">
        <div class="container space-2 space-top-md-5 space-bottom-md-3">
            <div class="w-md-80 w-lg-60">
                <h1 class="text-primary"><span class="font-weight-semi-bold">Tikket</span> Termos e condições</h1>

                <p>
                    Olá e bem vindo ao Tikket. Por favor, leia nossos Termos e Condições de Uso e <a href="{{ route('privacy') }}">Política de Privacidade</a>
                    com cuidado, porque eles afetam seus direitos legais, incluindo um acordo para resolver quaisquer disputas que possam surgir entre nós. Esperamos que você
                    esteja sentado confortavelmente e ouvindo boa música.
                </p>

                <p>Vamos lá.</p>
            </div>
        </div>

        <div class="d-none d-lg-block w-lg-40 content-centered-y right-0 z-index-n1 ml-9">
            <figure class="ie-bg-elements-2">
                <img src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.1/svg/components/bg-elements-2.svg" alt="Image Description">
            </figure>
        </div>
    </div>

    <div class="bg-light">
        <div class="container space-2 space-md-3">
            <div class="row">
                <div id="stickyBlockStartPoint" class="col-md-4 col-lg-3 mb-7 mb-md-0">
                    <nav class="js-sticky-block card border-0 bg-primary"
                         data-has-sticky-header="true"
                         data-offset-target="#logoAndNav"
                         data-sticky-view="md"
                         data-start-point="#stickyBlockStartPoint"
                         data-end-point="#stickyBlockEndPoint"
                         data-offset-top="24"
                         data-offset-bottom="24">
                        <ul class="js-scroll-nav list-group list-group-transparent list-group-white list-group-flush list-group-borderless py-3 px-5">
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#publicity">Publicidade</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#limitations-of-use">Limitação de Uso</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#copyright">Direitos Autorais</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#technological-risks">Riscos Tecnológicos</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#third-party-sites">Links para sites de Terceiros</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#changes">Mudanças no portal</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#terms-update">Alteração dos termos de uso</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#indenization">Indenização</a>
                            </li>
                            <li>
                                <a class="list-group-item list-group-item-action py-3" href="#forum">Foro</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <article class="col-md-8 col-lg-9">
                    @include('about.components.terms.publicity')
                    {{--<hr class="my-0">
                    @include('about.components.terms.limitations-of-use')
                    <hr class="my-0">
                    @include('about.components.terms.copyright')
                    <hr class="my-0">
                    @include('about.components.terms.technological-risks')
                    <hr class="my-0">
                    @include('about.components.terms.third-party-sites')
                    <hr class="my-0">
                    @include('about.components.terms.changes')
                    <hr class="my-0">
                    @include('about.components.terms.terms-update')
                    <hr class="my-0">
                    @include('about.components.terms.indenization')
                    <hr class="my-0">
                    @include('about.components.terms.forum')--}}
                </article>
            </div>
        </div>
    </div>

    <div id="stickyBlockEndPoint"></div>
@endsection

@push('scripts')
    <script async src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.2/js/components/hs.sticky-block.js"></script>
    <script async src="{{ getenv('AWS_CDN_ENDPOINT') }}/template/front/2.0.2/js/components/hs.scroll-nav.js"></script>

    <script>
        $(window).on('load', function () {
            $.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
                duration: 700
            });
        });

        $(document).on('ready', function () {
            setTimeout(function () {
                $.HSCore.components.HSStickyBlock.init('.js-sticky-block');
            }, 300);
        });
    </script>
@endpush
