@extends('layouts.auth')

@section('content')
    <div id="vue-login">
        <loading-component :is-loading="isLoading"></loading-component>

        <form class="mt-5" method="POST">
            <div class="mb-7">
                <h2 class="h3 text-primary font-weight-normal mb-0">Bem-vindo <span class="font-weight-bold">de volta</span></h2>
                <p>Acesse para gerenciar sua conta.</p>

                <alert-vue v-show="alert.active" :type="alert.type" :msg="alert.msg"></alert-vue>
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
                <div class="d-flex justify-content-between align-items-center">
                    <label class="h6 small d-block text-uppercase" for="password">Senha</label>

                    <div class="mb-2">
                        <a class="small u-link-muted" href="{{ route('account-recovery') }}">Esqueceu sua senha?</a>
                    </div>
                </div>

                <input type="password" class="form-control" name="password" placeholder="********" id="password"
                       v-model="password" data-vv-as="'Senha'" v-validate="'required'" data-vv-validate-on="change" @keyup.enter="loginSubmit">

                <div v-show="errors.has('password')" class="invalid-feedback" style="display: block">
                    @{{ errors.first('password') }}
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-8">
                    <span>É novo por aqui?</span>
                    <a href="{{ route('register') }}">Registre-se</a>
                </div>

                <div class="col-4 text-right">
                    <button type="button" class="btn btn-primary transition-3d-hover" @click="loginSubmit">Acessar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix("js/auth/login.js") }}"></script>
@endpush
