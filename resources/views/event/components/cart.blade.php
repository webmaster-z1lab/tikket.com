<div class="container space-2">
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
            @if(NULL !== $entrance->attributes->lot)
                <div class="row mb-sm-2">
                    <div class="col-sm-8 col-lg-9">
                        <h4 class="h6 text-primary mb-0">{{ $entrance->attributes->name }}</h4>

                        @if($event->fee_is_hidden)
                            <p class="text-dark mb-0">@money($entrance->attributes->lot->price, 'BRL')</p>
                        @else
                            <p class="text-dark mb-0">@money($entrance->attributes->lot->value, 'BRL') + @money($entrance->attributes->lot->fee, 'BRL') de taxa adm.</p>
                        @endif

                        <small class="d-block text-secondary mb-2">
                            Lote {{ $entrance->attributes->lot->number }} - Max. {{ $entrance->attributes->max_buy }}
                            @if($entrance->attributes->max_buy > 1) ingressos @else ingresso @endif por pessoa
                        </small>
                    </div>

                    <div class="col-sm-4 col-lg-3">
                        <div class="input-group input-group-sm mb-3 entrance">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary" type="button"><i class="fas fa-minus"></i></button>
                            </div>

                            <label for="{{ $entrance->id }}" class="sr-only">Número de entradas {{ $entrance->attributes->name }}</label>

                            <input type="hidden" class="js-lot" value="{{ $entrance->attributes->lot->number }}">
                            <input type="hidden" class="js-entrance" value="{{ $entrance->id }}">

                            <input readonly type="text" class="form-control js-quantity text-center text-primary" value="0" data-max="{{ $entrance->attributes->max_buy }}"
                                   data-price="{{ $entrance->attributes->lot->price/100 }}" id="{{ $entrance->id }}">

                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mb-sm-2">
                    <div class="col-sm-8 col-lg-9">
                        <h4 class="h6 text-primary mb-0">{{ $entrance->attributes->name }}</h4>

                        <small class="d-block text-secondary mb-2">
                            Lote ESGOTADO
                        </small>
                    </div>

                    <div class="col-sm-4 col-lg-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary disabled" type="button" disabled><i class="fas fa-minus disabled"></i></button>
                            </div>

                            <label for="{{ $entrance->id }}" class="sr-only">Número de entradas {{ $entrance->attributes->name }}</label>

                            <input readonly type="text" class="form-control js-quantity" value="ESGOTADO" id="{{ $entrance->id }}">

                            <div class="input-group-append">
                                <button class="btn btn-outline-primary disabled" type="button" disabled><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
