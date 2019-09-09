@extends('layouts.default')

@section('content')
    @include('about.components.about-hero')

    <article class="container space-2 space-md-3" id="featuresSection">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
            <span class="btn btn-xs btn-soft-success btn-pill mb-2">O que fazemos?</span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="space-bottom-2">
                    <p>
                        O Tikket é uma plataforma moderna desenvolvida para entregar a melhor experiência de compra e venda de ingressos online.
                    </p>

                    <p>
                        Oferecemos um ambiente dinâmico e confiável, onde cada um pode vender e comprar ingressos, além de ter contato direto com os organizadores assim como os
                        organizadores podem atender com mais velocidade e qualidade a todos os seus clientes.
                    </p>

                    <p>
                        O Tikket é uma marca registrada cujo os direitos são detidos pela <a href="https://z1lab.com.br">Z1lab Soluções Digitais LTDA, pessoa jurídica de direito
                            privado, inscrita no CNPJ sob o nº 31.565.855/0001-93.</a>
                    </p>
                </div>

                <div class="space-bottom-2">
                    <h2 class="text-primary"><strong class="font-weight-semi-bold">Fácil</strong> de usar</h2>

                    <p>
                        O nosso site é uma ferramenta em constante desenvolvimento buscando melhorias nos processos, agilizando o processo de compra e venda de ingressos, a gestão de
                        pedidos e seus respectivos ingressos além do atendimento e conexão entre participantes e organizadores.
                    </p>
                </div>

                <div class="space-bottom-2">
                    <h2 class="text-primary"><strong class="font-weight-semi-bold">Visibilidade</strong> e agilidade para nossos organizadores</h2>

                    <p>
                        Oferecemos para os nossos organizadores uma melhor visibilidade do seus eventos através de ferramentas de publicação que os posicionam perto de quem realmente
                        interessa além da facilidade de contato com o cliente e integração às redes sociais.
                    </p>

                    <p>
                        Cadastrar o seu evento e vender ingressos é simples e rápido através de qualquer dispositivo conectado à internet.
                    </p>
                </div>
            </div>
        </div>
    </article>

    @include('home.components.cta')
@endsection
