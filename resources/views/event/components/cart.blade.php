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

        <div class="row">
            <div class="col-sm-8 col-lg-9">
                <h3 class="h5 mb-0 text-primary">Total: <span>R$ <span class="js-total">0,00</span></span></h3>
                <p class="small">Tem um cupom de desconto? Você pode adicioná-lo no próximo passo.</p>
            </div>

            <div class="col-sm-4 col-lg-3">
                <button type="submit" class="btn btn-primary btn-block transition-3d-hover js-action">
                    <i class="fas fa-cart-plus mr-1"></i>Realizar compra
                </button>
            </div>
        </div>
    </form>
</div>
