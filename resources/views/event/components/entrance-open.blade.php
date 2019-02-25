<div class="row mb-sm-2">
    <div class="col-sm-8 col-lg-9">
        <h4 class="h6 text-primary mb-0">{{ $entrance->name }}</h4>

        @if($event->fee_is_hidden)
            <p class="text-dark mb-0">{{ $entrance->price }}</p>
        @else
            <p class="text-dark mb-0">{{ $entrance->value }} + {{ $entrance->fee }} de taxa adm.</p>
        @endif

        <small class="d-block text-secondary mb-2">
            Lote {{ $entrance->lot->number }} - Max. {{ $entrance->max_buy }}
            @if($entrance->max_buy > 1) ingressos @else ingresso @endif por pessoa
        </small>
    </div>

    <div class="col-sm-4 col-lg-3">
        <div class="input-group input-group-sm mb-3 entrance">
            <div class="input-group-prepend">
                <button class="btn btn-outline-primary" type="button"><i class="fas fa-minus"></i></button>
            </div>

            <label for="{{ $entrance->id }}" class="sr-only">Número de entradas {{ $entrance->name }}</label>

            <input type="hidden" class="js-lot" value="{{ $entrance->lot->number }}">
            <input type="hidden" class="js-entrance" value="{{ $entrance->id }}">

            <input readonly type="text" class="form-control js-quantity text-center text-primary" value="0" data-max="{{ $entrance->max_buy }}"
                   data-price="{{ $entrance->lot->price/100 }}" id="{{ $entrance->id }}">

            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
