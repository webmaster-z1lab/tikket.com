<template>
    <div>
        <loading-component :is-loading="isLoading"></loading-component>

        <form  method="POST" id="reset-form" novalidate="novalidate">
            <div id="forgotPassword" data-target-group="idForm">
                <header class="text-center mb-7">
                    <h2 class="h4 mb-0">Recuperação de senha</h2>
                    <p>Digite seu endereço de e-mail para enviarmos as instruções de recuperação para você.</p>

                    <alert-vue v-show="alert.active" :type="alert.type" :msg="alert.msg" title="Recuperação de senha"></alert-vue>
                </header>

                <div class="form-group mb-4" :class="errors.has('email') ? 'u-has-error' : ''">
                    <label class="sr-only" for="recoveryEmail">Email</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </span>
                        </div>

                        <input type="email" class="form-control" name="email" placeholder="Seu email" id="recoveryEmail"
                               v-model="email" data-vv-as="'Email'" v-validate="'required|email'" data-vv-validate-on="change" @keyup.enter="resetSubmit">
                    </div>

                    <div v-show="errors.has('email')" class="invalid-feedback" style="display: block">
                        {{ errors.first('email') }}
                    </div>
                </div>

                <div class="mb-2">
                    <button type="button" class="btn btn-block btn-primary transition-3d-hover" @click="resetSubmit">Recuperar senha</button>
                </div>

                <hr class="my-2">

                <div class="text-center mb-4">
                    <span class="small text-muted">Lembra da sua senha?</span>
                    <a class="js-animation-link small" href="javascript:;" @click="$emit('exchange', 'login-form')">Acessar</a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {sendAuth} from "../../../vendor/common";
    import AlertVue from '../../../components/alertComponent'
    import LoadingComponent from '../../../components/loadingComponent'

    export default {
        name: "PasswordRecoveryForm",
        components: {
            AlertVue,
            LoadingComponent
        },
        data: () => ({
            isLoading: false,
            email: '',
            alert: {
                active: false,
                msg: {},
                type: ''
            }
        }),
        methods: {
            resetSubmit() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            Pace.start()
                            this.isLoading = true
                            this.alert.active = false

                            await sendAuth(process.env.MIX_AUTH_SERVER_API + '/recovery', {email: this.email}, 'POST').then(
                                response => {
                                    this.alert.active = true
                                    this.alert.msg.detail = 'Tudo certo! Agora você deve verificar seu email para terminar o processo.'
                                    this.alert.type = 'success'
                                }
                            ).catch(
                                error => {
                                    if (_.isObject(error.response.data)) {
                                        this.alert.active = true
                                        this.alert.msg = error.response.data.errors
                                        this.alert.type = 'danger'
                                    } else {
                                        console.dir(error)
                                    }
                                }
                            ).finally( () => {
                                Pace.stop()
                                this.isLoading = false
                            })
                        }
                    }
                )
            }
        }
    }
</script>
