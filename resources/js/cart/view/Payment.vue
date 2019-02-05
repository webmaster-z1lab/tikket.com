<template>
    <form>
        <loading-component :is-loading="isLoading"></loading-component>

        <div v-if="checkDocument" class="mb-3">
            <div class="alert alert-warning" role="alert">
                <p class="alert-text" style="font-size: .9375rem">
                    Verificamos que você ainda não preencheu suas informações básicas de usuário <i class="fas fa-user-circle"></i>! <br>
                    Por isso vamos pedir apenas oque é necessario para efetuar sua compra. <br>
                    Esses dados não serão pedidos em comprar futuras!
                </p>
            </div>

            <div class="mb-3">
                <h2 class="h5 mb-0">Dados Básicos do Comprador <i class="fas fa-user-circle"></i></h2>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="js-form-message mb-3" :class="errors.has('document_costumer') ? 'u-has-error' : ''">
                        <label class="form-label">
                            CPF <span class="text-danger">*</span>
                        </label>

                        <the-mask class="form-control u-form__input" type="text" name="document_costumer" id="document_costumer"
                                  placeholder="000.000.000-00"
                                  v-validate="'required|cpf'" data-vv-as="'CPF'"
                                  mask="###.###.###-##" v-model="document_costumer">
                        </the-mask>

                        <div v-show="errors.has('document_costumer')" class="invalid-feedback" style="display: block">
                            {{ errors.first('document_costumer') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="js-form-message mb-3" :class="errors.has('phone_costumer') ? 'u-has-error' : ''">
                        <label class="form-label">
                            Telefone <span class="text-danger">*</span>
                        </label>

                        <the-mask class="form-control u-form__input" type="text" name="phone_costumer" id="phone_costumer"
                                  placeholder="(00) 00000-0000 ou (00) 0000-0000"
                                  v-validate="'required|phone'" data-vv-as="'Telefone'"
                                  :mask="['(##) ####-####', '(##) #####-####']" v-model="phone_costumer">
                        </the-mask>

                        <div v-show="errors.has('phone_costumer')" class="invalid-feedback" style="display: block">
                            {{ errors.first('phone_costumer') }}
                        </div>
                    </div>
                </div>
            </div>

            <hr>
        </div>

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
                <div class="js-form-message mb-6" :class="errors.has('installment') ? 'u-has-error' : ''">
                    <label class="form-label">
                        Opções de pagamento <span class="text-danger">*</span>
                    </label>

                    <select class="custom-select" aria-invalid="false" name="installment" v-model="installment" v-validate="'required'" :data-vv-as="'Opções de pagamento'">
                        <option value="" selected="">Selecione uma das opções de pagamento</option>
                        <option v-for="option in installments" :value="option">
                            {{`${option.quantity}x de `}} {{option.installmentAmount | currency}}
                        </option>
                    </select>

                    <div v-show="errors.has('installment')" class="invalid-feedback" style="display: block">
                        {{ errors.first('installment') }}
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
                        CVV <span class="text-danger">*</span>
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
                <div class="js-form-message mb-3" :class="errors.has('document') ? 'u-has-error' : ''">
                    <label class="form-label">
                        CPF <span class="text-danger">*</span>
                    </label>

                    <the-mask class="form-control u-form__input" type="text" name="document" id="document"
                              placeholder="000.000.000-00"
                              v-validate="'required|cpf'" data-vv-as="'CPF'"
                              mask="###.###.###-##" v-model="document">
                    </the-mask>

                    <div v-show="errors.has('document')" class="invalid-feedback" style="display: block">
                        {{ errors.first('document') }}
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

                    <the-mask class="form-control u-form__input" type="text" name="birth_date" id="birth_date"
                              placeholder="##/##/####" v-validate="'required|date_format:DD/MM/YYYY|ofage'" data-vv-as="Data de Nascimento" :masked="true"
                              :mask="'##/##/####'" v-model="birth_date">
                    </the-mask>

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

        <div class="row" v-if="completeAddress">
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
            <button type="button" @click="submitForm" class="btn btn-primary transition-3d-hover">Concluir</button>
        </div>
    </form>
</template>

<script>
    import moment from 'moment'
    import swal from 'sweetalert2'
    import LoadingComponent from '../../components/loadingComponent'
    import LocalStorage from "../../vendor/storage"

    import {TheMask} from 'vue-the-mask'
    import {createCardHash, createCardToken, getBrand, getCEP, getInstallment} from "../../vendor/api";
    import {mapActions, mapState} from 'vuex'
    import {sendAPIPOST, toSeek} from "../../vendor/common";

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
            date_base: moment().endOf('day').subtract(18, 'years').format('DD/MM/YYYY'),
            installments: {},
            installment: {},
            brand: '',
            card_number: '',
            card_holder: '',
            card_expiration_date: '',
            card_cvv: '',
            isLoading: false,
            hash: null,
            token: null,
            birth_date: '',
            document: '',
            phone: '',
            street: '',
            number: '',
            district: '',
            cep: '',
            state: '',
            city: '',
            complement: '',
            ibge_id: '',
            completeAddress: false,
            phone_costumer: '',
            document_costumer: ''
        }),
        computed: {
            ...mapState({
                cart: state => state.cart,
                user: state => state.user.attributes
            }),
            imgBrand() {
                return `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${this.brand}.png`
            },
            checkDocument() {
                return !this.user.document
            }
        },
        watch: {
            async card_number(value) {
                this.brand = ''

                if (value.length === 16) {
                    await getBrand(value).then((response) => {
                        let amount = ((this.cart.attributes.amount + this.cart.attributes.fee - this.cart.attributes.discount) / 100)

                        this.brand = response.brand.name

                        getInstallment(response.brand.name, amount).then((response) => {
                            this.installments = response.installments[this.brand]
                        }).catch((error) => {
                            this.setError(error.errors)
                        })
                    }).catch((error) => this.setError('Número de cartão não reconhecido.'))
                }
            },
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
                    ).finally(() => {
                        Pace.stop()
                        this.isLoading = false
                    })
                }
            }
        },
        methods: {
            ...mapActions(['changeCart']),
            submitForm() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            Pace.start()
                            this.isLoading = true

                            await createCardToken(this.card_number, this.brand, this.card_cvv, this.card_expiration_date).then(
                                (response) => {
                                    this.token = response.card.token
                                }
                            ).catch(
                                (error) => {
                                    let erro = collect(error.errors).first()

                                    this.setError(erro)
                                }
                            )

                            if (_.isNull(this.token) || _.isNull(this.hash)) return

                            let data = {
                                callback: 'conclusion',
                                hash: this.hash,
                                costumer: {
                                    document: this.document_costumer,
                                    phone: this.phone_costumer
                                },
                                card: {
                                    brand: this.brand,
                                    number: this.card_number.substr(-4),
                                    token: this.token,
                                    installments: this.installment.quantity,
                                    parcel: this.installment.installmentAmount,
                                    holder: {
                                        phone: this.phone,
                                        name: this.card_holder,
                                        document: this.document,
                                        birth_date: moment(this.birth_date, 'DD/MM/YYYY').format('YYYY-MM-DD'),
                                        address: {
                                            street: this.street,
                                            number: this.number,
                                            complement: this.complement,
                                            district: this.district,
                                            postal_code: this.cep,
                                            city: this.city,
                                            state: this.state
                                        }
                                    }
                                },
                                _method: 'PATCH'
                            }

                            if (this.user.document) {
                                delete data.costumer
                            }

                            await sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/carts/${this.cart.id}/card`, data).then(
                                async response => {
                                    await this.changeCart(response.data.data)

                                    new LocalStorage('cart__').setItem('user', response.data.data, response.data.data.attributes.expires_at)

                                    this.$router.push({name: 'conclusion'})
                                }
                            ).catch(
                                (error) => {
                                    if (_.isObject(error.response)) {
                                        swal({
                                            type: 'error',
                                            title: 'Ops, algo deu errado!',
                                            text: error.response.data.errors.detail
                                        })
                                    } else {
                                        console.dir(error)
                                    }
                                }
                            ).finally(
                                () => {
                                    Pace.stop()
                                    this.isLoading = false
                                }
                            )
                        }
                    }
                )
            },
            setError(error) {
                Pace.stop()
                this.isLoading = false

                swal.mixin({
                    type: 'error',
                    toast: true,
                    position: 'bottom',
                    showConfirmButton: false,
                    timer: 3000,
                    title: error
                });
            }
        },
        mounted() {
            toSeek(`${process.env.MIX_API_PAYMENT}/api/session`).then(
                async response => {
                    await PagSeguroDirectPayment.setSessionId(response.session)
                    await createCardHash().then((response) => this.hash = response).catch((error) => this.setError(error))
                    this.isLoading = false
                }
            )
        }
    }
</script>
