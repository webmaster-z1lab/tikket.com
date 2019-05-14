<div class="container space-bottom-2">
    <form id="shop">
        <input type="hidden" name="event" value="{{ $id }}">
        <input type="hidden" name="callback" value="{{ route('cart') }}">

        <div class="d-none d-sm-block mb-4 border-bottom">
            <div class="row">
                <div class="col-sm-8 col-lg-9">
                    <h3 class="h5">Entradas</h3>
                </div>
                <div class="col-sm-4 col-lg-3">
                    <h3 class="h5">Quantidade</h3>
                </div>
            </div>
        </div>

        @foreach($entrances as $key => $entrance)
            @include("event.components.entrance-$entrance->status")

            @if($key + 1 < count($entrances))
                <hr class="d-block d-sm-none">
            @endif
        @endforeach

        <hr class="my-4">

        <div class="row d-none" id="error-alert">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Oops! Sua compra não pode ser concluída.</h4>
                    <p class="alert-text" id="error-text"></p>

                    <hr>

                    <p class="alert-text">
                        <i class="far fa-comments"></i> Para obter ajuda fale com a gente utilizando um dos nossos <a class="text-danger" href="{{ route('contact') }}">canais de contato.</a>
                    </p>

                    <h6>DETALHES DO ERRO</h6>
                    <ul id="error-details"></ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 col-lg-9">
                <h3 class="h5 mb-0 text-primary">Total: <span>R$ <span class="js-total">0,00</span></span></h3>
                <p class="small">Tem um cupom de desconto? Você pode adicioná-lo no próximo passo.</p>
            </div>

            <div class="col-sm-4 col-lg-3">
                @if(\Auth::check())
                    <button type="submit" class="btn btn-primary btn-block transition-3d-hover js-action">
                        <i class="fas fa-cart-plus mr-1"></i>Realizar compra
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-block transition-3d-hover">
                        <i class="fas fa-cart-plus mr-1"></i>Faça login para comprar
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>
