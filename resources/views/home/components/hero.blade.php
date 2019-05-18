<div class="d-lg-flex position-relative">
    <div class="container align-items-lg-center flex-lg-wrap text-center space-top-2 space-top-md-4 space-top-lg-3">
        <div class="w-100 mt-5">
            <div class="mb-5">
                <h1 class="display-4 font-size-md-down-5 font-weight-semi-bold">Seu próximo evento está aqui</h1>
                <p>O Tikket é uma plataforma digital completa para <strong class="text-primary">festas, shows e workshops.</strong></p>
            </div>

            <form method="post" class="js-validate">
                <div class="w-md-75 w-xl-60 mx-md-auto mb-4" :class="errors.has('search') ? 'u-has-error' : ''">
                    <label class="sr-only" for="signupSrEmail">Evento, cidade, estado...</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Evento, cidade, estado..."
                               aria-label="Evento, cidade, estado..." v-model="keyword" v-validate="'required'">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary btn-wide" @click="search">Pesquisar</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="small">
                <span class="font-weight-medium">Você também pode:</span>
                <a class="link-muted mx-2" href="{{ config('app.domains.admin') }}/evento/novo-evento">
                    <i class="fas fa-rocket text-primary mr-1"></i>criar seu próprio evento
                </a>
            </div>
        </div>
    </div>

    <div class="d-none d-lg-block content-centered-y left-0 w-100 max-width-40 z-index-n1">
        <figure class="ie-abstract-shapes-1">
            <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/components/abstract-shapes-9.svg" alt="Image Description">
        </figure>
    </div>
    <!-- End SVG Component -->

    <!-- SVG Component -->
    <div class="d-none d-lg-block content-centered-y right-0 w-100 max-width-35 z-index-n1">
        <figure class="ie-abstract-shapes-10">
            <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/components/abstract-shapes-10.svg" alt="Image Description">
        </figure>
    </div>
</div>
