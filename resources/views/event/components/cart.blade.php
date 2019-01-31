<div class="container space-2">
    <form action="{{ route('event.test') }}" method="post" id="shop">
        @csrf
        @method('POST')

        <input type="hidden" name="event" value="{{ str_random(24) }}">
        <input type="hidden" name="callback" value="test">

        <div class="d-none d-sm-block mb-4 border-bottom">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="h5">Entradas</h3>
                </div>
                <div class="col-sm-4">
                    <h3 class="h5">Quantidade</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <h4 class="h6 mb-0">Inteira - R$ 50,00 + R$ 5,00 de taxa adm.</h4>
                <small class="d-block text-secondary mb-2">Primeiro lote - Max. 5 ingresso(s) por pessoa</small>
            </div>
            <div class="col-sm-4">
                <div class="input-group mb-3 entrance">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="button"><i class="fas fa-minus"></i></button>
                    </div>

                    <input type="hidden" name="tickets[0][lot]" value="1">
                    <input type="hidden" name="tickets[0][entrance]" value="{{ str_random(24) }}">

                    <input readonly type="number" class="form-control" value="0" data-max="5" data-price="55.00" name="tickets[0][quantity]">

                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <hr class="d-block d-sm-none">

        <div class="row">
            <div class="col-sm-8">
                <h4 class="h6 mb-0">Meia-entrada - R$ 25,00 + R$ 2,50 de taxa adm.</h4>
                <small class="d-block text-secondary mb-2">Primeiro lote - Max. 1 ingresso(s) por pessoa</small>
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3 entrance">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="button"><i class="fas fa-minus"></i></button>
                    </div>

                    <input type="hidden" name="tickets[1][lot]" value="1">
                    <input type="hidden" name="tickets[1][entrance]" value="{{ str_random(24) }}">

                    <input readonly type="number" class="form-control" value="0" data-max="1" data-price="27.50" name="tickets[1][quantity]">

                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="row">
            <div class="col-sm-8">
                <h3 class="h5 mb-0">Total: <span class="text-warning">R$ <span class="js-total">0,00</span></span></h3>
                <p class="small">Tem um cupom de desconto? Você pode adicioná-lo no próximo passo.</p>
            </div>

            <div class="col-sm-4">
                <button type="button" class="btn btn-primary btn-block transition-3d-hover js-action">
                    <i class="fas fa-cart-plus mr-1"></i>Finalizar Compra
                </button>
            </div>
        </div>
    </form>
</div>
