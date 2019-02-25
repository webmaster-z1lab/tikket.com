<div class="row mb-sm-2">
    <div class="col-sm-8 col-lg-9">
        <h4 class="h6 text-primary mb-0">{{ $entrance->name }}</h4>

        <small class="d-block text-secondary mb-2">
            Lote ESGOTADO
        </small>
    </div>

    <div class="col-sm-4 col-lg-3">
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-outline-primary disabled" type="button" disabled><i class="fas fa-minus disabled"></i></button>
            </div>

            <label for="{{ $entrance->id }}" class="sr-only">Número de entradas {{ $entrance->name }}</label>

            <input readonly type="text" class="form-control js-quantity" value="ESGOTADO" id="{{ $entrance->id }}">

            <div class="input-group-append">
                <button class="btn btn-outline-primary disabled" type="button" disabled><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
