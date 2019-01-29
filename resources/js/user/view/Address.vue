<template>
    <div class="container">
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="row justify-content-center">
            <div class="text-center m-9" v-if="!addressCheck && !newAddress">
                <figure id="icon8" class="w-25 mx-auto mb-4">
                    <img src="https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/icons/icon-8.svg" alt="SVG" data-parent="#icon8">
                </figure>

                <div class="mb-4">
                    <h1 class="h4"><strong>Nenhum endereço encontrado.</strong></h1>

                    <p>Adicione um endereço. O endereço é um dado muito importante para plena navegação e utilização do nosso site de forma mais ágil.</p>
                </div>

                <button type="button" class="btn btn-sm u-btn-primary--air u-btn-wide transition-3d-hover" @click="addAddress">
                    Add Endereço
                    <span class="fa fa-angle-right ml-2"></span>
                </button>
            </div>

            <div class="col-12 space-2" v-if="addressCheck">
                <div class="card w-100">
                    <div class="card-body p-5">
                        <div class="row justify-content-between align-items-center mb-3">
                            <div class="col-6">
                                <div class="small text-secondary">
                                    <span class="fas fa-bookmark text-primary text-uppercase mr-1"></span>
                                    Endereço Ativo
                                </div>
                            </div>

                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-soft-primary z-index-4" @click="addAddress">
                                    <i class="fas fa-map-marked"></i> Trocar endereço
                                </button>
                            </div>
                        </div>

                        <div class="d-sm-flex">
                            <div class="text-center">
                                <figure>
                                    <img class="w-50 d-none d-sm-block" src="/theme/svg/icons/icon-8.svg" alt="SVG">
                                </figure>
                            </div>

                            <div class="mr-3">
                                <div class="mb-3">
                                    <h3 class="h5 mb-1">{{ address.city }} - {{ address.state }}</h3>
                                    <p class="font-size-1">{{ address.formatted }}</p>
                                </div>

                                <div class="d-sm-flex align-items-sm-center">
                                    <div class="u-ver-divider u-ver-divider--none-sm pr-4 mb-3 mb-sm-0 mr-4">
                                        <h4 class="small font-weight-normal text-secondary mb-0">Cadastrado em</h4>
                                        <span class="text-dark">{{ address.created_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-6" v-if="newAddress">
                <hr class="mt-1 mb-7">

                <div class="mb-3">
                    <h2 class="h5 mb-0" v-if="!addressCheck">Novo Endereço</h2>

                    <p>
                        <strong>
                            Insira seu CEP para pesquisarmos seu endereço.
                            <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Não sei o meu CEP
                            </a>
                        </strong>
                    </p>
                </div>

                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-6" :class="errors.has('cep') ? 'u-has-error' : ''">
                                <label class="d-block small text-uppercase font-weight-medium" for="cep">
                                    CEP <span class="text-danger">*</span>
                                </label>

                                <the-mask class="form-control u-form__input" type="text" name="cep" id="cep"
                                          placeholder="00000-000"
                                          v-validate="'required|cep'" data-vv-as="'CEP'" mask="#####-###"
                                          v-model.lazy="cep"></the-mask>

                                <div v-show="errors.has('cep')" class="invalid-feedback" style="display: block">
                                    {{ errors.first('cep') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-show="completeAddress">
                        <div class="col-md-9">
                            <div class="form-group mb-6" :class="errors.has('street') ? 'u-has-error' : ''">
                                <label class="d-block small text-uppercase font-weight-medium" for="street">
                                    Logradouro <span class="text-danger">*</span>
                                </label>

                                <input class="form-control" type="text" name="street" id="street"
                                       placeholder="Nome da rua"
                                       v-model="street" data-vv-as="'Logradouro'" v-validate="'required'">

                                <div v-show="errors.has('street')" class="invalid-feedback" style="display: block">
                                    {{ errors.first('street') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mb-6" :class="errors.has('number') ? 'u-has-error' : ''">
                                <label class="d-block small text-uppercase font-weight-medium">
                                    Número <span class="text-danger">*</span>
                                </label>

                                <input class="form-control" type="number" name="number" placeholder="Ex: 55"
                                       v-model="number" data-vv-as="'Número'" v-validate="'required'">

                                <div v-show="errors.has('number')" class="invalid-feedback" style="display: block">
                                    {{ errors.first('number') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-6" :class="errors.has('district') ? 'u-has-error' : ''">
                                <label class="d-block small text-uppercase font-weight-medium" for="district">
                                    Bairro <span class="text-danger">*</span>
                                </label>

                                <input class="form-control" type="text" name="district" id="district" placeholder="Nome do Bairro"
                                       v-model="district" data-vv-as="'Bairro'" v-validate="'required'">

                                <div v-show="errors.has('district')" class="invalid-feedback" style="display: block">
                                    {{ errors.first('district') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-6" :class="errors.has('complement') ? 'u-has-error' : ''">
                                <label class="d-block small text-uppercase font-weight-medium" for="complement">
                                    Complemento
                                </label>

                                <input class="form-control" type="text" name="complement" id="complement" placeholder="Ex: Casa, Loja 01..." v-model="complement">

                                <div v-show="errors.has('complement')" class="invalid-feedback" style="display: block">
                                    {{ errors.first('complement') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-6">
                                <label class="d-block small text-uppercase font-weight-medium" for="state">
                                    Estado <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control u-form__input disabled" id="state" readonly disabled
                                       name="state" v-model="state">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-6">
                                <label class="d-block small text-uppercase font-weight-medium" for="city">
                                    Cidade <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control u-form__input disabled" id="city" readonly disabled
                                       name="city" v-model="city">
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="button" class="btn btn-primary transition-3d-hover"
                                    @click="submitForm">
                                <i class="fas fa-save"></i> Salvar
                            </button>

                            <button type="button" class="btn btn-secondary transition-3d-hover"
                                    @click="canceledAddress">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import LoadingComponent from '../../components/loadingComponent'

    import {mapActions, mapState} from 'vuex'
    import {refreshData, sendCommon} from "../../vendor/common"
    import {getCEP} from "../../vendor/api";
    import {TheMask} from 'vue-the-mask'

    export default {
        name: "Address",
        $_veeValidate: {
            validator: 'new'
        },
        components: {
            LoadingComponent,
            TheMask
        },
        data: () => ({
            address: {},
            isLoading: false,
            newAddress: false,
            completeAddress: false,
            street: '',
            number: '',
            district: '',
            cep: '',
            state: '',
            city: '',
            complement: '',
            ibge_id: ''
        }),
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes,
                addressUser: state => state.dataBasic.data.relationships.address,
                links: state => state.dataBasic.links
            }),
            addressCheck() {
                if (this.addressUser) {
                    this.address = this.addressUser.data.attributes

                    return true
                }
                return false
            }
        },
        watch: {
            async cep(value) {
                this.completeAddress = false

                if (value.length === 8) {
                    Pace.start()
                    this.isLoading = true

                    await getCEP(value).then(
                        response => {
                            if (_.isUndefined(response.data.erro)) {
                                let cep = response.data

                                this.completeAddress = true

                                this.state = cep.uf
                                this.district = cep.bairro
                                this.city = cep.localidade
                                this.street = cep.logradouro
                                this.ibge_id = cep.ibge
                            }
                        }
                    ).catch(
                        error => this.completeAddress = false
                    ).finally(
                        () => {
                            Pace.stop()
                            this.isLoading = false
                        }
                    )
                }
            }
        },
        methods: {
            ...mapActions(['changeDataBasic']),
            submitForm() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            Pace.start()
                            this.isLoading = true

                            let dataForm = {
                                street: this.street,
                                number: this.number,
                                district: this.district,
                                postal_code: this.cep,
                                state: this.state,
                                city: this.city,
                                complement: this.complement,
                                ibge_id: this.ibge_id,
                                _method: 'POST'
                            }

                            await sendCommon(`${this.links.self}/addresses`, dataForm, 'POST').then(
                                async response => {
                                    await refreshData().then(response => this.changeDataBasic(response.data))
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
            },
            addAddress() {
                this.newAddress = true
            },
            canceledAddress() {
                this.newAddress = false
            }
        }
    }
</script>
