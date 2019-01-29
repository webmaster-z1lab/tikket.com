@extends('layouts.auth')

@section('content')
    <form class="mt-5" action="{{ OpenID::resetRoute() }}" id="reset-form" method="POST">
        <div class="mb-7">
            <h2 class="h3 text-primary font-weight-normal mb-0">Recuperar sua conta do <span class="font-weight-bold">quantofica.com</span></h2>
            <p>Digite uma nova senha de acesso para a sua conta.</p>
        </div>

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="continue" value="{{ OpenID::askForToken() }}">

        <div class="form-group mb-4">
            <label class="h6 small d-block text-uppercase" for="password">Nova Senha</label>

            <input type="password" class="form-control" name="password" required id="password"
                   placeholder="********"
                   aria-label="********"
                   data-msg="Senha inválida. Tente novamente."
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
        </div>

        <div class="form-group mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <label class="h6 small d-block text-uppercase" for="password_confirmation">Confirmação da Senha</label>
            </div>

            <input type="password" class="form-control" name="password_confirmation" required id="password_confirmation"
                   placeholder="********"
                   aria-label="********"
                   data-msg="A senhas não conferem"
                   data-error-class="u-has-error"
                   data-success-class="u-has-success">
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-6">

            </div>

            <div class="col-6 text-right">
                <button type="button" class="btn btn-primary transition-3d-hover" id="reset-button">Recuperar</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ mix('js/login.js') }}"></script>
@endpush
