<template>
    <form>
        <div class="mb-3">
            <h2 class="h5 mb-0">Informações de Pagamento</h2>
        </div>
        <div class="js-focus-state mb-3" :class="errors.has('card_number') ? 'u-has-error' : ''">
            <label class="form-label">
                Número do Cartão <span class="text-danger">*</span>
            </label>

            <div class="input-group">
                <the-mask type="text" class="form-control" name="card_number" placeholder="**** **** **** ****"
                          v-model.lazy="card_number"
                          v-validate="'required|credit_card'" data-vv-as="'Número do Cartão'"
                          mask="#### #### #### ####"></the-mask>
                <div class="input-group-append" v-if="brand !== ''">
                    <span class="input-group-text">
                        <img :src="imgBrand" width="42" height="20" :alt="brand"/>
                    </span>
                </div>
            </div>

            <div v-show="errors.has('card_number')" class="invalid-feedback" style="display: block">
                {{ errors.first('card_number') }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="js-form-message mb-6" :class="errors.has('card_holder') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Nome do Titular <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" name="card_holder" placeholder="Jack Wayley"
                           v-model="card_holder"
                           v-validate="'required'" data-vv-as="'Nome do Titular'">

                    <div v-show="errors.has('card_holder')" class="invalid-feedback" style="display: block">
                        {{ errors.first('card_holder') }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="js-form-message mb-6"
                     :class="errors.has('card_expiration_date') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Data de Expiração <span class="text-danger">*</span>
                    </label>

                    <the-mask type="text" class="form-control" name="card_expiration_date" placeholder="MM/YYYY"
                              v-model="card_expiration_date"
                              v-validate="'required'" data-vv-as="'Data de Expiração'" mask="##/####"
                              :masked="true"></the-mask>

                    <div v-show="errors.has('card_expiration_date')" class="invalid-feedback"
                         style="display: block">
                        {{ errors.first('card_expiration_date') }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="js-form-message mb-6" :class="errors.has('card_cvv') ? 'u-has-error' : ''">
                    <label class="form-label">
                        CVV
                    </label>

                    <input type="text" class="form-control" name="card_cvv" placeholder="***" v-model="card_cvv"
                           v-validate="'required|numeric|length:3'" data-vv-as="'CVV'">

                    <div v-show="errors.has('card_cvv')" class="invalid-feedback" style="display: block">
                        {{ errors.first('card_cvv') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <h2 class="h5 mb-0">Dados do titular do cartão</h2>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="js-form-message mb-3" :class="errors.has('card_holder') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Nome do Titular <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" name="card_holder" placeholder="Jack Wayley"
                           v-model="card_holder"
                           v-validate="'required'" data-vv-as="'Nome do Titular'">

                    <div v-show="errors.has('card_holder')" class="invalid-feedback" style="display: block">
                        {{ errors.first('card_holder') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="js-form-message mb-3" :class="errors.has('cpf') ? 'u-has-error' : ''">
                    <label class="form-label">
                        CPF <span class="text-danger">*</span>
                    </label>

                    <the-mask class="form-control u-form__input" type="text" name="cpf" id="cpf"
                              placeholder="000.000.000-00"
                              v-validate="'required|cpf'" data-vv-as="'CPF'"
                              mask="###.###.###-##" v-model="cpf">
                    </the-mask>

                    <div v-show="errors.has('cpf')" class="invalid-feedback" style="display: block">
                        {{ errors.first('cpf') }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="js-form-message mb-3" :class="errors.has('phone') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Telefone <span class="text-danger">*</span>
                    </label>

                    <the-mask class="form-control u-form__input" type="text" name="phone" id="phone"
                              placeholder="(00) 00000-0000 ou (00) 0000-0000"
                              v-validate="'required|phone'" data-vv-as="'Telefone'"
                              :mask="['(##) ####-####', '(##) #####-####']" v-model="phone">
                    </the-mask>

                    <div v-show="errors.has('phone')" class="invalid-feedback" style="display: block">
                        {{ errors.first('phone') }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="js-form-message mb-3" :class="errors.has('birth_date') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Data de Nascimento <span class="text-danger">*</span>
                    </label>

                    <input class="form-control" name="birth_date" id="birth_date" v-validate="'required'" data-vv-as="Data de Nascimento" v-model.lazy="birth_date"/>
                    <div v-show="errors.has('birth_date')" class="invalid-feedback" style="display: block">
                        {{ errors.first('birth_date') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <h2 class="h6 mb-0">Endereço</h2>
            <small>Insira seu CEP para pesquisarmos seu endereço.
                <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Não sei o meu CEP
                </a>
            </small>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="js-form-message mb-3" :class="errors.has('cep') ? 'u-has-error' : ''">
                    <label class="form-label">
                        CEP <span class="text-danger">*</span>
                    </label>

                    <the-mask class="form-control u-form__input" type="text" name="cep" id="cep"
                              placeholder="00000-000"
                              v-validate="'required|cep'" data-vv-as="'CEP'" mask="#####-###" v-model.lazy="cep">
                    </the-mask>
                    <div v-show="errors.has('cep')" class="invalid-feedback" style="display: block">
                        {{errors.first('cep') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row ml-1" v-if="completeAddress">
            <div class="col-md-9">
                <div class="js-form-message mb-3" :class="errors.has('street') ? 'u-has-error' : ''">
                    <label class="form-label">
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
                <div class="js-form-message mb-3" :class="errors.has('number') ? 'u-has-error' : ''">
                    <label class="form-label">
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
                <div class="js-form-message mb-3" :class="errors.has('district') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Bairro <span class="text-danger">*</span>
                    </label>

                    <input class="form-control" type="text" name="district" id="district"
                           placeholder="Nome do Bairro"
                           v-model="district" data-vv-as="'Bairro'" v-validate="'required'">

                    <div v-show="errors.has('district')" class="invalid-feedback" style="display: block">
                        {{ errors.first('district') }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="js-form-message mb-3" :class="errors.has('complement') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Complemento
                    </label>

                    <input class="form-control" type="text" name="complement" id="complement" placeholder="Ex: Casa, Loja 01..." v-model="complement">

                    <div v-show="errors.has('complement')" class="invalid-feedback" style="display: block">
                        {{ errors.first('complement') }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="js-form-message mb-3">
                    <label class="form-label">
                        Estado <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control u-form__input disabled" id="state" readonly disabled name="state" v-model="state">
                </div>
            </div>

            <div class="col-md-6">
                <div class="js-form-message mb-3">
                    <label class="form-label">
                        Cidade <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control u-form__input disabled" id="city" readonly disabled name="city" v-model="city">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <router-link :to="{name: 'information'}">
                <span class="fas fa-angle-left mr-2"></span> Voltar
            </router-link>
            <router-link :to="{name: 'payment'}" class="btn btn-primary transition-3d-hover">
                Continuar
            </router-link>
        </div>
    </form>
</template>

<script>
    import LoadingComponent from '../../components/loadingComponent'

    import {TheMask} from 'vue-the-mask'
    import {mapState, mapActions} from 'vuex'
    import {getBrand, createCardHash, createCardToken} from "../../vendor/api";
    import {toSeek, sendAPIPOST} from "../../vendor/common";

    export default {
        name: "Payment",
        $_veeValidate: {
            validator: 'new'
        },
        components: {
            TheMask,
            LoadingComponent
        },
        data: () => ({
            amount: 0,
            plan: '',
            additional_name: [],
            brand: '',
            card_number: '',
            card_holder: '',
            card_expiration_date: '',
            card_cvv: '',
            isLoading: false,
            hash: null,
            token: null
        }),
        // computed: {
        //     ...mapState({
        //         user: state => state.user.data.attributes,
        //         cart: state => state.cart,
        //         plans: state => state.cart.relationships.plans,
        //         additional: state => state.cart.relationships.additional
        //     }),
        //     imgBrand() {
        //         return `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${this.brand}.png`
        //     },
        //     checkRoute() {
        //         return this.$route.name !== 'confirmation'
        //     }
        // },
        // watch: {
        //     async card_number(value) {
        //         this.brand = ''
        //
        //         if (value.length === 16) {
        //             await getBrand(value).then((response) => this.brand = response.brand.name).catch((error) => this.setError('Número de cartão não reconhecido.'))
        //         }
        //     },
        //     plan(value) {
        //         this.setAmount()
        //     },
        //     additional_name(value) {
        //         this.setAmount()
        //     }
        // },
        // methods: {
        //     ...mapActions(['changeCart']),
        //     submitForm() {
        //         this.$validator.validateAll().then(
        //             async res => {
        //                 if (res) {
        //                     Pace.start()
        //                     this.isLoading = true
        //
        //                     await createCardToken(this.card_number, this.brand, this.card_cvv, this.card_expiration_date).then(
        //                         (response) => {
        //                             this.token = response.card.token
        //                         }
        //                     ).catch(
        //                         (error) => {
        //                             let erro = collect(error.errors).first()
        //
        //                             this.setError(erro)
        //                         }
        //                     )
        //
        //                     if (_.isNull(this.token) || _.isNull(this.hash)) return
        //
        //                     let data = {
        //                         plan_id: this.plan,
        //                         callback: this.cart.attributes.callback === 'confirmation' ? 'confirmation' : 'data_payment',
        //                         card: {
        //                             name: this.card_holder,
        //                             number: this.card_number.substr(-4),
        //                             brand: this.brand,
        //                             token: this.token
        //                         },
        //                         hash: this.hash,
        //                         additional: this.additional_name,
        //                         _method: 'PUT'
        //                     }
        //
        //                     await sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/carts/${this.cart.id}`, data).then(
        //                         async result => {
        //                             await this.changeCart(result.data.data)
        //                             if (this.$route.name !== 'confirmation') this.$router.push({name: 'data_payment'})
        //                         }
        //                     ).catch(
        //                         (error) => {
        //                             if (_.isObject(error.response)) {
        //                                 toast({
        //                                     type: 'error',
        //                                     title: error.response.data.errors.detail
        //                                 })
        //                             } else {
        //                                 console.dir(error)
        //                             }
        //                         }
        //                     ).finally(
        //                         () => {
        //                             Pace.stop()
        //                             this.isLoading = false
        //                         }
        //                     )
        //                 }
        //             }
        //         )
        //     },
        //     setError(error) {
        //         Pace.stop()
        //         this.isLoading = false
        //
        //         toast({
        //             type: 'error',
        //             title: error
        //         })
        //     },
        //     setAmount() {
        //         let plan = _.find(this.plans, ['id', this.plan])
        //
        //         if (_.isEmpty(this.additional_name)) {
        //             this.amount = plan.attributes.values.final
        //         } else {
        //             let additional = _.find(this.additional, ['attributes._id', _.head(this.additional_name)])
        //
        //             this.amount = plan.attributes.values.final + additional.attributes.value
        //         }
        //     }
        // },
        // mounted() {
        //     toSeek(`${process.env.MIX_API_PAYMENT}/api/session`).then(
        //         async response => {
        //             await PagSeguroDirectPayment.setSessionId(response.session)
        //             await createCardHash().then((response) => this.hash = response).catch((error) => this.setError(error))
        //             this.plan = this.cart.attributes.plan_id
        //             this.additional_name = this.cart.attributes.additional
        //             this.isLoading = false
        //         }
        //     )
        // }
    }
</script>
