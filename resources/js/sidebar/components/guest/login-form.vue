<template>
    <div>
        <loading-component :is-loading="isLoading"></loading-component>

        <form method="POST" id="login-form">
            <div id="login" data-target-group="idForm">
                <header class="text-center mb-7">
                    <h2 class="h4 mb-0">Bem vindo de volta!</h2>
                    <p>Acesse para gerir a sua conta.</p>

                    <alert-vue v-show="alert.active" :type="alert.type" :msg="alert.msg"></alert-vue>
                </header>

                <div class="form-group mb-4" :class="errors.has('email') ? 'u-has-error' : ''">
                    <label class="sr-only" for="signinEmail">Email</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="signinEmailLabel">
                                <span class="fas fa-at"></span>
                            </span>
                        </div>

                        <input type="email" class="form-control" name="email" placeholder="Email" id="signinEmail" aria-describedby="signinEmailLabel"
                               v-model="email" data-vv-as="'Email'" v-validate="'required|email'"
                               data-vv-validate-on="change">
                    </div>

                    <div v-show="errors.has('email')" class="invalid-feedback" style="display: block">
                        {{ errors.first('email') }}
                    </div>
                </div>

                <div class="form-group mb-2" :class="errors.has('password') ? 'u-has-error' : ''">
                    <label class="sr-only" for="signinPassword">Password</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="signinPasswordLabel">
                                <span class="fas fa-lock u-form__text-inner"></span>
                            </span>
                        </div>

                        <input type="password" class="form-control u-form__input" name="password" placeholder="Senha" id="signinPassword"
                               v-model="password" data-vv-as="'Senha'" v-validate="'required'" aria-describedby="signinPasswordLabel"
                               data-vv-validate-on="change"
                               @keyup.enter="loginSubmit">
                    </div>

                    <div v-show="errors.has('password')" class="invalid-feedback" style="display: block">
                        {{ errors.first('password') }}
                    </div>
                </div>

                <!-- End Input -->

                <div class="d-flex justify-content-end mb-4">
                    <a class="js-animation-link small link-muted" href="javascript:;"
                       @click="$emit('exchange', 'password-recovery-form')">Esqueceu a sua senha?</a>
                </div>

                <div class="mb-2">
                    <button type="button" class="btn btn-block btn-primary transition-3d-hover"
                            @click="loginSubmit">Login
                    </button>
                </div>

                <hr class="my-2">

                <div class="text-center mb-4">
                    <h4>É novo por aqui?</h4>
                    <a class="btn btn-block btn-outline-primary transition-3d-hover" href="javascript:;" @click="$emit('exchange', 'register-form')">
                        Registre-se
                    </a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {askForToken, sendAuth} from "../../../vendor/common"
    import AlertVue from '../../../components/alertComponent'
    import LoadingComponent from '../../../components/loadingComponent'

    export default {
        name: "LoginForm",
        components: {
            AlertVue,
            LoadingComponent
        },
        data: () => ({
            isLoading: false,
            email: '',
            password: '',
            alert: {
                active: false,
                msg: {},
                type: ''
            }
        }),
        methods: {
            loginSubmit() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            this.isLoading = true
                            this.alert.active = false

                            await sendAuth(process.env.MIX_AUTH_SERVER_API + '/login', {
                                email: this.email,
                                password: this.password
                            }, 'POST').then(
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
