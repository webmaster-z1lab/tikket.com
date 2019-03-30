@extends('layouts.default')

@section('content')
    @include('about.components.about-hero')

    <article class="container space-2 space-md-3" id="featuresSection">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
            <span class="btn btn-xs btn-soft-success btn-pill mb-2">O que fazemos?</span>
        </div>

        <div class="row">
            <div class="col-12">
                <p>
                    O Tikket é uma plataforma moderna focada na experiência de venda de ingressos online.
                </p>

                <p>
                    Oferecemos uma base dinâmica e confiável, onde cada um pode comprar seus ingressos, além de ter contato direto com os organizadores assim como os
                    organizadores podem atender com mais velocidade e qualidade a todos os seus clientes.
                </p>

                <p>
                    O Tikket.com.br é uma marca registrada cujo os direitos são detidos pela <a href="https://z1lab.com.br">Z1lab Soluções Digitais LTDA.</a>
                </p>

                <h2 class="text-primary"><strong class="font-weight-semi-bold">Fácil</strong> de usar</h2>

                <p>
                    O nosso site é uma ferramenta em constante desenvolvimento buscando melhorias nos processos, agilizando o processo de compra e venda de ingressos, além de toda a gestão de pedidos e seus respectivos ingressos.
                </p>

                <h2 class="text-primary"><strong class="font-weight-semi-bold">Visibilidade</strong> e agilidade para nossos anunciantes</h2>

                <p>
                    Oferecemos para os nossos organizadores uma melhor visibilidade do seus eventos através de ferramentas de publicação que os posicionam perto de quem realmente
                    interessa além da facilidade de contato com o cliente e integração às redes sociais.
                </p>

                <p>
                    Cadastrar o seu evento e vender ingressos é simples e rápido através de qualquer dispositivo conectado à internet.
                </p>
            </div>
        </div>
    </article>

    @include('home.components.cta')
@endsection
