@extends('layouts.default')

@section('content')
    @include('about.components.about-hero')

    <article class="container space-2 space-md-3" id="featuresSection">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-9">
            <span class="btn btn-xs btn-soft-success btn-pill mb-2">O que fazemos?</span>
        </div>

        <div class="row">
            <a class="col-12">
                <p>
                    O quantofica.com é um portal confiável, ágil e intuitivo, que contém tudo que o usuário gostaria de saber em relação a preços de produtos e serviços.
                </p>

                <p>
                    É possível em um só lugar obter valores de diversos gastos do seu dia-a-dia, encontrar imóveis, repúblicas, produtos e serviços do seu interesse. Utilize a
                    plataforma do nosso site para encontrar o que precisa e se você for um corretor, vendedor ou prestador de serviços ainda pode aproveitar os recursos especiais
                    que oferecemos para anunciantes.
                </p>

                <p>
                    Oferecemos uma base dinâmica e confiável, onde cada um pode avaliar a informação oferecida, além de ter contato direto com os anunciantes assim como os
                    anunciantes podem atender com mais velocidade e qualidade a todos os seus clientes.
                </p>

                <h2 class="text-primary"><strong class="font-weight-semi-bold">Fácil</strong> de usar</h2>

                <p>
                    Com informações atuais e válidas o quantofica.com oferece para os seus usuários ferramentas que facilitam encontrar valores de produtos necessários no
                    dia-a-dia, de prestação de serviços e permite encontrar o imóvel ideal para o seu orçamento.
                </p>

                <p>
                    O nosso site é uma ferramenta em constante desenvolvimento buscando melhorias nos processos, agilizando as tarefas de consultas e criando ferramentas úteis para
                    o seu cotidiano.
                </p>

                <h2 class="text-primary"><strong class="font-weight-semi-bold">Visibilidade</strong> e agilidade para nossos anunciantes</h2>

                <p>
                    Oferecemos para os nossos anunciantes uma melhor visibilidade do seu negócio através de ferramentas de publicidade de que os posicionam perto de quem realmente
                    interessa além da exibição do seu portifólio e integração às redes sociais.
                </p>

                <p>
                    Cadastrar o seu produto ou serviço é simples e rápido através de qualquer dispositivo conectado à internet.
                </p>
            </a>
        </div>
    </article>

    @include('home.components.cta')
@endsection
