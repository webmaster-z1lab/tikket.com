<footer class="container">
    <div class="border-bottom space-2">
        <div class="row justify-content-lg-between">
            <div class="col-6 col-sm-4 col-lg-2 mb-7 mb-lg-0">
                <h4 class="h6">Conta</h4>

                <ul class="list-group list-group-flush list-group-borderless mb-0">
                    <li><a class="list-group-item list-group-item-action" href="#">Perfil</a></li>
                    <li><a class="list-group-item list-group-item-action" href="#">Ingressos</a></li>
                    <li><a class="list-group-item list-group-item-action" href="#">Meus Eventos</a></li>
                    <li><a class="list-group-item list-group-item-action" href="#">Configurações</a></li>
                </ul>
            </div>

            <div class="col-6 col-sm-4 col-lg-2 mb-7 mb-lg-0">
                <h4 class="h6">Empresa</h4>

                <ul class="list-group list-group-flush list-group-borderless mb-0">
                    <li><a class="list-group-item list-group-item-action" href="{{ route('about') }}">Quem somos</a></li>
                    <li><a class="list-group-item list-group-item-action" href="{{ route('features') }}">Facilidades</a></li>
                    <li><a class="list-group-item list-group-item-action" href="{{ route('contact') }}">Contato</a></li>
                </ul>
            </div>

            <div class="col-sm-4 col-lg-2 mb-7 mb-lg-0">
                <h4 class="h6">Fique conectado</h4>

                <ul class="list-group list-group-flush list-group-borderless mb-0">
                    <li>
                        <a class="list-group-item list-group-item-action" href="//www.facebook.com/tikketeventos/" target="_blank">
                            <span class="fab fa-facebook text-primary mr-2"></span>
                            Facebook
                        </a>
                    </li>
                    <li>
                        <a class="list-group-item list-group-item-action" href="//www.instagram.com/tikketeventos/" target="_blank">
                            <span class="fab fa-instagram text-primary mr-2"></span>
                            Instagram
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-5 text-right">
                <span class="h2 font-weight-semi-bold">Fale com a gente</span>
                <small class="d-block font-weight-medium">WhatsApp e tel: <span class="text-secondary font-weight-normal">(31) 99715-0447</span></small>
                <small class="d-block font-weight-medium">E-mail: <a class="font-weight-normal" href="mailto:contato@z1lab.com.br">contato@z1lab.com.br</a></small>
            </div>
        </div>
    </div>

    <div class="row justify-content-sm-between align-items-md-center py-7">
        <div class="col-sm-8 mb-4 mb-sm-0">
            <ul class="list-inline list-group-flush list-group-borderless font-size-1 mb-0">
                <li class="list-inline-item pl-0">
                    © Tikket. {{ date('Y') }} Z1Lab.
                </li>
                <li class="list-inline-item">
                    <a class="link-muted" href="{{ route('contact') }}">Suporte</a>
                </li>
                <li class="list-inline-item">
                    <a class="link-muted" href="{{ route('terms') }}">Termos de Uso</a>
                </li>
                <li class="list-inline-item">
                    <a class="link-muted" href="{{ route('privacy') }}">Privacidade</a>
                </li>
            </ul>
        </div>

        <div class="col-sm-4 text-sm-right">
            <a class="d-inline-flex align-items-center" href="//z1lab.com.br" aria-label="Z1Lab Soluções Digitais" target="_blank">
                <img src="https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/z1lab/logo/powered_by_black.svg" alt="Z1Lab Soluções Digitais" style="width: 180px;">
            </a>
        </div>
    </div>
</footer>
