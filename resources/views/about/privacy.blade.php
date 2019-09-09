@extends('layouts.default')

@section('content')
    <div class="container space-top-2 space-top-md-4 space-bottom-1 overflow-hidden">
        <div class="w-lg-80 mx-lg-auto">
            <div class="card shadow-sm">

                <div class="card-header position-relative bg-primary space-top-2 space-bottom-3 rounded-top-pseudo px-7 px-md-9">
                    <h1 class="text-white font-weight-semi-bold">Política de privacidade e cookies</h1>
                    <p class="text-white-70">Última modificação: 06 de setembro de 2019</p>

                    <figure class="position-absolute right-0 bottom-0 left-0">
                        <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/components/wave-1-bottom-sm.svg" alt="Image Description" width="100%" height="140px">
                    </figure>
                </div>

                <div class="card-body p-7 p-md-9">
                    <div class="mb-7">
                        <div class="mb-3">
                            <h3 class="h5 text-primary font-weight-semi-bold">Introdução</h3>
                        </div>

                        <p>
                            Obrigado por usar nossos produtos e serviços. O Tikket é uma plataforma desenvolvida e mantida pela <strong>Z1Lab Soluções Digitais LTDA</strong>, CNPJ 31.565.855/0001-93, localizada na cidade de Viçosa, Minas Gerais, Brasil.
                        </p>

                        <p>
                            Ao usar nossos serviços, você concorda com estes termos. Por favor, leia-os com atenção.
                        </p>

                        <p>
                            Nós possuímos vários serviços, por isso, às vezes, termos adicionais ou requisitos de produtos (incluindo requisitos de idade) podem ser aplicadas.
                            Termos adicionais estarão disponíveis com o relevante serviço e esses termos adicionais tornam-se parte de seu contrato conosco se você usar esses
                            serviços.
                        </p>
                    </div>

                    <div class="mb-7">
                        <div class="mb-3">
                            <h3 class="h5 text-primary font-weight-semi-bold">Privacidade e Cookies</h3>
                        </div>

                        @include('about.components.privacy.policy')
                    </div>

                    <div class="mb-7">

                        <div class="mb-3">
                            <h3 class="h5 text-primary font-weight-semi-bold">Segurança</h3>
                        </div>

                        @include('about.components.privacy.security')
                    </div>

                    <div class="mb-7">
                        <div class="mb-3">
                            <h3 class="h5 text-primary font-weight-semi-bold">Termos de Uso</h3>
                        </div>

                        <p>
                            O USUÁRIO expressamente aceita os termos e condições elencados no Termo de Uso, os quais ficam aqui incorporados por referência.
                        </p>
                    </div>

                    <div class="mb-7">
                        <div class="mb-3">
                            <h3 class="h5 text-primary font-weight-semi-bold">Links com outros sites</h3>
                        </div>

                        <p>
                            Uma vez no Tikket, você poderá ser conduzido, via link, a outros sites. Tenha em mente que esses outros sites podem estar recolhendo
                            informações sobre você e ter suas próprias políticas de confidencialidade e de privacidade. Lembre-se que, ao se dirigir a tais portais fora do
                            Tikket, toda informação que você vier a trocar estará fora do nosso controle e de nossa responsabilidade.
                        </p>
                    </div>

                    <div class="mb-7">
                        <div class="mb-3">
                            <h3 class="h5 text-primary font-weight-semi-bold">Alterações na política de privacidade</h3>
                        </div>

                        <p>
                            O SITE poderá alterar esta Política de Privacidade a qualquer momento. Como toda alteração na presente Política será imediatamente publicada no
                            quantofica.com, solicitamos que você pratique uma leitura periódica para se informar sobre a forma pela qual o SITE está coletando, tratando e
                            protegendo suas informações.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-25 content-centered-y left-0 z-index-n1 mt-9">
        <figure class="ie-circle-1">
            <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/components/circle-1.svg" alt="Background image">
        </figure>
    </div>

    <div class="w-35 content-centered-y right-0 z-index-n1 mt-n9">
        <figure class="ie-bg-elements-4">
            <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/components/bg-elements-4.svg" alt="Background image">
        </figure>
    </div>

    <div class="position-absolute right-0 bottom-0 left-0 z-index-n1">
        <figure class="ie-bg-elements-3">
            <img src="{{ config('theme.cdn_url') }}template/front/2.0.1/svg/components/bg-elements-3.svg" alt="Background image">
        </figure>
    </div>
@endsection
