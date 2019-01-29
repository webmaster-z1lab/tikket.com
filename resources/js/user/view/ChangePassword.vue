<template>
    <div>
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="bg-light">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12">
                    <div class="container space-2">
                        <div class="mb-5">
                            <h3 class="h5 mb-1">Mudar Senha</h3>
                        </div>

                        <form method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-6" :class="errors.has('current_password') ? 'u-has-error' : ''">
                                        <label class="d-block small text-uppercase font-weight-medium" for="current_password">
                                            Senha Atual <span class="text-danger">*</span>
                                        </label>

                                        <input class="form-control" type="password" id="current_password"
                                               name="current_password" placeholder="Entre com sua senha atual"
                                               v-model="current_password" data-vv-as="'Senha Atual'"
                                               v-validate="'required'" data-vv-validate-on="change">

                                        <div v-show="errors.has('current_password')" class="invalid-feedback" style="display: block">
                                            {{ errors.first('current_password') }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-6" :class="errors.has('password') ? 'u-has-error' : ''">
                                        <label class="d-block small text-uppercase font-weight-medium" for="password">
                                            Nova Senha <span class="text-danger">*</span>
                                        </label>

                                        <input class="form-control u-form__input" type="password" name="password" id="password"
                                               placeholder="********" ref="password"
                                               v-model="password" data-vv-as="'Nova Senha'"
                                               v-validate="'required|min:8'" data-vv-validate-on="change">

                                        <div v-show="errors.has('password')" class="invalid-feedback" style="display: block">
                                            {{ errors.first('password') }}
                                        </div>
                                    </div>

                                    <div class="form-group mb-6" :class="errors.has('password_confirmation') ? 'u-has-error' : ''">
                                        <label class="d-block small text-uppercase font-weight-medium" for="password_confirmation">
                                            Confirmar Nova Senha
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input class="form-control u-form__input" type="password" id="password_confirmation"
                                               name="password_confirmation" placeholder="********"
                                               v-model="password_confirmation" data-vv-as="'Confirmar nova senha'"
                                               v-validate="'required|confirmed:password'"
                                               data-vv-validate-on="change" @keyup.enter="submitForm">

                                        <div v-show="errors.has('password_confirmation')" class="invalid-feedback" style="display: block">
                                            {{ errors.first('password_confirmation') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary transition-3d-hover" @click="submitForm">
                                <i class="fas fa-save"></i> Salvar
                            </button>

                            <button type="button" class="btn btn-secondary transition-3d-hover" @click="$router.go(-1)">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LoadingComponent from '../../components/loadingComponent'

    import {mapState} from 'vuex'
    import {sendCommon} from "../../vendor/common"

    export default {
        name: "ChangePassword",
        $_veeValidate: {
            validator: 'new'
        },
        components: {
            LoadingComponent
        },
        data: () => ({
            isLoading: false,
            password_confirmation: '',
            password: '',
            current_password: ''
        }),
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes,
                links: state => state.dataBasic.links
            })
        },
        methods: {
            submitForm() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            Pace.start()
                            this.isLoading = true

                            let dataForm = {
                                password_confirmation: this.password_confirmation,
                                password: this.password,
                                current_password: this.current_password,
                                _method: 'PATCH'
                            }

                            await sendCommon(`${this.links.self}/password`, dataForm, 'POST').then(
                                response => {
                                    toast({
                                        type: 'success',
                                        title: 'Senha alterada com sucesso!'
                                    })

                                    this.password_confirmation = ''
                                    this.password = ''
                                    this.current_password = ''
                                }
                            ).catch(
                                error => {
                                    if (_.isObject(error.response.data)) {
                                        toast({
                                            type: 'error',
                                            title: error.response.data.errors.detail
                                        })
                                    } else {
                                        console.dir(error)
                                    }
                                }
                            ).finally(() => {
                                    Pace.stop()
                                    this.isLoading = false
                                }
                            )
                        }
                    })
            }
        }
    }
</script>
