<template>
    <div class="col-12">
        <div class="card card-frame card-frame-highlighted mb-4">
            <div class="card-body">
                <h5 class="card-title">Pagamento por Cartão de Crédito</h5>

                <h6 class="card-title mt-4">Informações do cartão</h6>

                <div class="row">
                    <div class="col-12 mb-2" :class="errors.has('card_number') ? 'u-has-error' : ''">
                        <label class="form-label required">Número do Cartão</label>

                        <div class="input-group">
                            <the-mask type="text" class="form-control" name="card_number" placeholder="**** **** **** ****" data-vv-as="'Número do Cartão'"
                                      v-model.lazy="card_number" v-validate="'required|credit_card'" mask="#### #### #### ####"/>
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

                    <div class="col-md-6 mb-2" :class="errors.has('installment') ? 'u-has-error' : ''">
                        <label for="installment" class="form-label required">
                            Opções de pagamento
                            <span v-if="getMaxInstallments() > 0">(em até {{ getMaxInstallments() }}x)</span>
                        </label>

                        <select id="installment" class="custom-select" aria-invalid="false" name="installment" v-if="getMaxInstallments() > 0"
                                v-model="installment" @change="setBill(installment.totalAmount)" v-validate="'required'" :data-vv-as="'Opções de pagamento'">

                            <option v-for="option in installments" :value="option">
                                {{`${option.quantity}x de `}} {{option.installmentAmount | currency}} ({{option.totalAmount | currency}})
                            </option>
                        </select>

                        <div v-else-if="this.loading_cc">
                            <input type="text" value="Carregando opções de pagamento..." class="form-control disabled" disabled>
                            <span class="loading"></span>
                        </div>

                        <input type="text" value="Forneça o número do cartão de crédito" class="form-control disabled" :class="{'loading' : loading_cc}" v-else disabled>

                        <div v-show="errors.has('installment')" class="invalid-feedback" style="display: block">
                            {{ errors.first('installment') }}
                        </div>
                    </div>

                    <div class="col-md-3 mb-2" :class="errors.has('card_expiration_date') ? 'u-has-error' : ''">
                        <label class="form-label required">Data de Expiração</label>

                        <the-mask type="text" class="form-control" name="card_expiration_date" placeholder="MM/YYYY" data-vv-as="'Data de Expiração'" mask="##/####"
                                  v-model="card_expiration_date" v-validate="'required'" :masked="true"/>

                        <div v-show="errors.has('card_expiration_date')" class="invalid-feedback"
                             style="display: block">
                            {{ errors.first('card_expiration_date') }}
                        </div>
                    </div>

                    <div class="col-md-3 mb-2" :class="errors.has('card_cvv') ? 'u-has-error' : ''">
                        <label class="form-label required">CVV</label>

                        <input type="text" class="form-control" name="card_cvv" placeholder="***" v-model="card_cvv" v-validate="'required|numeric|length:3'" data-vv-as="'CVV'">

                        <div v-show="errors.has('card_cvv')" class="invalid-feedback" style="display: block">
                            {{ errors.first('card_cvv') }}
                        </div>
                    </div>
                </div>

                <h6 class="card-title mt-4">Informações do titular do cartão</h6>

                <div class="row">
                    <div class="col-md-6 mb-2" :class="errors.has('card_holder') ? 'u-has-error' : ''">
                        <label class="form-label required">Nome do titular</label>

                        <input type="text" class="form-control" name="card_holder" v-model="card_holder" v-validate="'required'" data-vv-as="'Nome do Titular'" placeholder="Nome impresso no cartão">

                        <div v-show="errors.has('card_holder')" class="invalid-feedback" style="display: block">
                            {{ errors.first('card_holder') }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-2" :class="errors.has('document') ? 'u-has-error' : ''">
                        <label class="form-label required">CPF</label>

                        <the-mask class="form-control" type="text" name="document" id="document" placeholder="000.000.000-00"
                                  v-validate="'required|cpf'" data-vv-as="'CPF'" mask="###.###.###-##" v-model="document"/>

                        <div v-show="errors.has('document')" class="invalid-feedback" style="display: block">
                            {{ errors.first('document') }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-2" :class="errors.has('phone') ? 'u-has-error' : ''">
                        <label class="form-label required">Telefone</label>

                        <the-mask class="form-control" type="text" name="phone" id="phone" placeholder="(00) 00000-0000 ou (00) 0000-0000"
                                  v-validate="'required|phone'" data-vv-as="'Telefone'" :mask="['(##) ####-####', '(##) #####-####']" v-model="phone"/>

                        <div v-show="errors.has('phone')" class="invalid-feedback" style="display: block">
                            {{ errors.first('phone') }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-2" :class="errors.has('birth_date') ? 'u-has-error' : ''">
                        <label class="form-label required">Data de Nascimento</label>

                        <the-mask class="form-control" type="text" name="birth_date" id="birth_date" placeholder="DD/MM/AAAA" data-vv-as="Data de Nascimento"
                                  v-validate="'required|date_format:dd/MM/yyyy|legal_age'" :masked="true" :mask="'##/##/####'" v-model="birth_date"/>

                        <div v-show="errors.has('birth_date')" class="invalid-feedback" style="display: block">
                            {{ errors.first('birth_date') }}
                        </div>
                    </div>
                </div>

                <data-address :data="address"/>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <router-link class="btn btn-secondary btn-wide transition-3d-hover" :to="{name: 'information'}">
                <span class="fas fa-file-signature mr-1"></span> Voltar
            </router-link>

            <button type="button" @click="conclusionPayment" class="btn btn-primary btn-wide transition-3d-hover">
                Concluir <i class="fas fa-check-circle ml-1"></i>
            </button>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import swal from 'sweetalert2'

    import DataAddress from "./DataAddress"

    import {TheMask} from 'vue-the-mask'
    import {createCardToken, getBrand, getInstallment} from "../../../../vendor/api";
    import {mapActions, mapState} from 'vuex'

    export default {
        name: "CreditCard",
        inject: ['$validator'],
        components: {
            TheMask,
            DataAddress
        },
        data: () => ({
            installments: {},
            installment: {},
            brand: '',
            card_number: '',
            card_holder: '',
            card_expiration_date: '',
            card_cvv: '',
            token: null,
            loading_cc: false,
            birth_date: '',
            document: '',
            phone: '',
            address: {
                street: '',
                number: '',
                district: '',
                postal_code: '',
                state: '',
                city: '',
                complement: ''
            }
        }),
        computed: {
            ...mapState({
                cart: state => state.cart,
                user: state => state.user.attributes,
                bill: state => state.bill
            }),
            imgBrand() {
                return `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${this.brand}.png`
            }
        },
        watch: {
            async card_number(value) {
                this.brand = ''

                if (value.length === 16) {
                    this.loading_cc = true
                    await getBrand(value).then((response) => {
                        let amount = ((this.cart.attributes.amount - this.cart.attributes.discount) / 100)

                        this.brand = response.brand.name

                        getInstallment(response.brand.name, amount).then((response) => {
                            this.installments = response.installments[this.brand]
                            this.installment = response.installments[this.brand][0]
                            this.loading_cc = false
                        }).catch((error) => {
                            this.setError(error.errors)
                        })
                    }).catch((error) => this.setError('Número de cartão não reconhecido.'))
                }
            }
        },
        methods: {
            ...mapActions(['changeBill']),
            async conclusionPayment() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            await createCardToken(this.card_number, this.brand, this.card_cvv, this.card_expiration_date)
                                .then((response) => {
                                    this.token = response.card.token
                                })
                                .catch((error) => {
                                    let erro = collect(error.errors).first()
                                    this.setError(erro)
                                })

                            if (_.isNull(this.token)) return

                            let data = {
                                address: this.address,
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
                                        birth_date: moment(this.birth_date, 'DD/MM/YYYY').format('YYYY-MM-DD')
                                    }
                                }
                            }

                            this.$emit('submit', data)
                        }
                    }
                )
            },
            setError(error) {
                swal.mixin({
                    type: 'error',
                    toast: true,
                    position: 'bottom',
                    showConfirmButton: false,
                    timer: 3000,
                    title: error
                });
            },
            setBill(data) {
                this.changeBill(data)
            },
            getMaxInstallments() {
                return _.size(this.installments)
            },
        }
    }
</script>

<style scoped>
    @keyframes loading {
        0% {
            transform-origin: 100% 100%;
            transform: rotate(0deg);
        }
        100% {
            transform-origin: 100% 100%;
            transform: rotate(360deg);
        }
    }
    .loading {
        width: 18px;
        height: 18px;
        margin: -5px -5px;
    }
    .loading:after {
        position: relative;
        float : right;
        margin: -43px 23px;
        display: inline-block;
        content: "";
        z-index: 11;
        width: 18px;
        height: 18px;
        border-radius: 200px 0 0;
        background: linear-gradient(45deg, rgba(0, 0, 0, 0) 0, #459ad7 50%, #459ad7 100%);
        animation: loading 0.5s linear infinite;
    }
</style>
