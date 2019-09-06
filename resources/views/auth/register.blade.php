@extends('layouts.auth')

@section('content')
    <div id="vue-register">
        <loading-component :is-loading="isLoading"></loading-component>

        <form class="mt-5" method="POST">
            <div class="mb-7">
                <h1 class="h3 text-primary font-weight-normal mb-0">Bem-vindo ao <span class="font-weight-bold">quantofica.com</span></h1>
                <p>Preencha o formulário para iniciar.</p>

                <alert-vue v-show="alert.active" :type="alert.type" :msg="alert.msg"></alert-vue>
            </div>

            <div class="form-group mb-4" :class="errors.has('name') ? 'u-has-error' : ''">
                <label class="h6 small d-block text-uppercase" for="name">Nome</label>

                <input type="text" class="form-control" name="name" placeholder="Nome" id="name"
                       v-model="name" data-vv-as="'Nome'" v-validate="'required'" data-vv-validate-on="change">

                <div v-show="errors.has('name')" class="invalid-feedback" style="display: block">
                    @{{ errors.first('name') }}
                </div>
            </div>

            <div class="form-group mb-4" :class="errors.has('email') ? 'u-has-error' : ''">
                <label class="h6 small d-block text-uppercase" for="email">Endereço de email</label>

                <input type="email" class="form-control" name="email" placeholder="email@exemplo.com" id="email"
                       v-model="email" data-vv-as="'Email'" v-validate="'required|email'" data-vv-validate-on="change">

                <div v-show="errors.has('email')" class="invalid-feedback" style="display: block">
                    @{{ errors.first('email') }}
                </div>
            </div>

            <div class="form-group mb-4" :class="errors.has('password') ? 'u-has-error' : ''">
                <label class="h6 small d-block text-uppercase" for="password">Senha</label>

                <input type="password" class="form-control" name="password" placeholder="********" id="password"
                       v-model="password" data-vv-as="'Senha'" v-validate="'required|min:8'" data-vv-validate-on="change" ref="password">

                <div v-show="errors.has('password')" class="invalid-feedback" style="display: block">
                    @{{ errors.first('password') }}
                </div>
            </div>

            <div class="form-group mb-3" :class="errors.has('password_confirm') ? 'u-has-error' : ''">
                <label class="h6 small d-block text-uppercase" for="password_confirmation">Confirmação de senha</label>

                <input type="password" class="form-control" name="password_confirm" placeholder="********" data-vv-validate-on="change" id="password-form"
                       v-model="password_confirm" data-vv-as="'Confirme a Senha'" v-validate="'required|confirmed:password'" @keyup.enter="registerSubmit">

                <div v-show="errors.has('password_confirm')" class="invalid-feedback" style="display: block">
                    @{{ errors.first('password_confirm') }}
                </div>
            </div>

            <div class="form-group mb-5">
                <div class="d-flex align-items-center text-muted">
                    <small>
                        Escolher Registrar significa que você concorda com os nossos <a href="{{ route('terms') }}" class="js-animation-link link-muted">termos de uso</a> e a nossa <a href="{{ route('privacy') }}" class="js-animation-link link-muted">política de privacidade e cookies</a>.
                    </small>
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-5 col-sm-6">
                    <span>Já possui uma conta?</span>
                    <a href="{{ route('login') }}">Acesse</a>
                </div>

                <div class="col-7 col-sm-6 text-right">
                    <button type="button" class="btn btn-primary u-btn-primary transition-3d-hover" @click="registerSubmit">Registrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix("js/auth/register.js") }}"></script>
@endpush
