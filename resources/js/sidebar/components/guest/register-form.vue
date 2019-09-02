<template>
    <div>
        <loading-component :is-loading="isLoading"></loading-component>

        <form method="POST" id="register-form">
            <header class="text-center mb-7">
                <h2 class="h4 mb-0">Bem vindo ao Tikket</h2>
                <p>Precisamos de alguns dados para começar.</p>

                <alert-vue v-show="alert.active" :type="alert.type" :msg="alert.msg"></alert-vue>
            </header>

            <div class="form-group mb-4" :class="errors.has('name') ? 'u-has-error' : ''">
                <div class="input-group">
                    <label class="sr-only" for="signUpName">Name</label>

                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fas fa-user"></span>
                        </span>
                    </div>

                    <input type="text" class="form-control" name="name" placeholder="Nome" id="signUpName"
                           v-model="name" data-vv-as="'Nome'" v-validate="'required'" data-vv-validate-on="change">
                </div>

                <div v-show="errors.has('name')" class="invalid-feedback" style="display: block">
                    {{ errors.first('name') }}
                </div>
            </div>

            <div class="form-group mb-4" :class="errors.has('email') ? 'u-has-error' : ''">
                <label class="sr-only" for="signUpEmail">Email</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-at"></span>
                        </span>
                    </div>

                    <input type="email" class="form-control" name="email" placeholder="E-mail" id="signUpEmail"
                           v-model="email" data-vv-as="'Email'" v-validate="'required|email'" data-vv-validate-on="change">
                </div>
                <div v-show="errors.has('email')" class="invalid-feedback" style="display: block">
                    {{ errors.first('email') }}
                </div>
            </div>

            <div class="form-group mb-4" :class="errors.has('password') ? 'u-has-error' : ''">
                <label class="sr-only" for="signUpPassword">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </span>
                    </div>

                    <input type="password" class="form-control" name="password" placeholder="Senha" id="signUpPassword"
                           v-model="password" data-vv-as="'Senha'" v-validate="'required|min:8'" data-vv-validate-on="change" ref="password">
                </div>
                <div v-show="errors.has('password')" class="invalid-feedback" style="display: block">
                    {{ errors.first('password') }}
                </div>
            </div>

            <div class="form-group mb-4" :class="errors.has('password_confirm') ? 'u-has-error' : ''">
                <label class="sr-only" for="signUpPasswordConfirmation">Password Confirmation</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-key"></span>
                        </span>
                    </div>

                    <input type="password" class="form-control" name="password_confirm" placeholder="Confirme a senha" data-vv-validate-on="change" id="signUpPasswordConfirmation" v-model="password_confirm" data-vv-as="'Confirme a Senha'" v-validate="'required|confirmed:password'" @keyup.enter="registerSubmit">
                </div>

                <div v-show="errors.has('password_confirm')" class="invalid-feedback" style="display: block">
                    {{ errors.first('password_confirm') }}
                </div>
            </div>

            <div class="mb-2">
                <button type="button" class="btn btn-block btn-primary transition-3d-hover" @click="registerSubmit">Criar minha conta</button>
            </div>

            <hr class="my-2">

            <div class="text-center mb-4">
                <span class="small text-muted">Já possui uma conta?</span>
                <a class="js-animation-link small" href="javascript:;"  @click="$emit('exchange', 'login-form')">Acesse</a>
            </div>
        </form>
    </div>
</template>

<script>
    import {sendAuth, askForToken} from "../../../vendor/common";
    import AlertVue from '../../../components/alertComponent'
    import LoadingComponent from '../../../components/loadingComponent'

    export default {
        name: "RegisterForm",
        components: {
            AlertVue,
            LoadingComponent
        },
        data: () => ({
            isLoading: false,
            name: '',
            email: '',
            password: '',
            password_confirm: '',
            alert: {
                active: false,
                msg: {},
                type: ''
            }
        }),
        methods: {
            registerSubmit() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            this.isLoading = true
                            this.alert.active = false

                            await sendAuth(
                                process.env.MIX_AUTH_SERVER_API + '/register',
                                {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirm},
                                'POST'
                            ).then(
                                response => {
                                    window.location.replace(`${askForToken()}&token=${response.access_token}`)
                                }
                            ).catch(
                                error => {
                                    this.isLoading = false

                                    if (_.isObject(error.response.data)) {
                                        this.alert.active = true
                                        this.alert.msg = error.response.data.errors
                                        this.alert.type = 'danger'
                                    } else {
                                        console.dir(error)
                                    }
                                }
                            )
                        }
                    }
                )
            }
        }
    }
</script>
