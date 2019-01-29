@extends('layouts.auth')

@section('content')
    <div id="vue-account-recovery">
        <loading-component :is-loading="isLoading"></loading-component>

        <form class="mt-5" method="POST">
            <div class="mb-7">
                <h1 class="h3 text-primary font-weight-normal mb-0">Esqueceu a sua <span
                        class="font-weight-bold">senha?</span></h1>
                <p>Digite seu endereço de e-mail para enviarmos as instruções de recuperação para você.</p>

                <alert-vue v-show="alert.active" :type="alert.type" :msg="alert.msg" title="Recuperação de senha"></alert-vue>
            </div>

            <div class="form-group mb-4">
                <label class="h6 small d-block text-uppercase" for="email">Endereço de email</label>

                <input type="email" class="form-control u-form__input" name="email" placeholder="email@exemplo.com"
                       v-model="email" data-vv-as="'Email'" v-validate="'required|email'" data-vv-validate-on="change"
                       @keyup.enter="resetSubmit">

                <div v-show="errors.has('email')" class="invalid-feedback" style="display: block">
                    @{{ errors.first('email') }}
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-4 col-sm-6">
                    <a href="{{ route('login') }}">Voltar para o login</a>
                </div>

                <div class="col-8 col-sm-6 text-right">
                    <button type="button" class="btn btn-primary transition-3d-hover" @click="resetSubmit">Recuperar
                        conta
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix("js/auth/account-recovery.js") }}"></script>
@endpush
