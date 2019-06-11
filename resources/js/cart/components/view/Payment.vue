<template>
    <form>
        <div v-if="cart.is_free">
            <div class="alert alert-primary" role="alert">
                <h5 class="alert-heading">Carrinho Grátis</h5>
                <hr>
                <p class="alert-text">
                    Verificamos que os items em seu carrinho são gratuitos ou você adicionou um cupom com um desconto muito especial!
                    Graças a isso voçê não necessita de informações para pagamento, clique no botão concluir para finalizar seu pedido.
                </p>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <router-link class="btn btn-secondary btn-wide transition-3d-hover" :to="{name: 'information'}">
                    <span class="fas fa-file-signature mr-1"></span> Voltar
                </router-link>

                <button type="button" @click="conclusionCart" class="btn btn-primary btn-wide transition-3d-hover">
                    Concluir <i class="fas fa-check-circle ml-1"></i>
                </button>
            </div>
        </div>

        <div v-else>
            <div class="row">
                <updating-user-data v-if="checkDocument" :data="customer"/>

                <div class="col-6">
                    <div class="card card-frame card-frame-highlighted mb-4">
                        <div class="card-body">
                            <div class="card border-0">
                                <div class="card-body p-0">
                                    <div class="row align-items-center">
                                        <div class="col-10">
                                            <div class="custom-control custom-radio d-flex align-items-center small">
                                                <input type="radio" class="custom-control-input" id="credit-card" name="credit-card" value="credit_card" v-model="form_payment">
                                                <label class="custom-control-label ml-1" for="credit-card">
                                                    <span class="d-block font-size-1 font-weight-medium mb-1">Cartão de Crédito</span>
                                                    <span class="d-block text-muted">Shipment may take 5-6 business days.</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2 text-muted">
                                            <i class="far fa-credit-card fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card card-frame card-frame-highlighted mb-4">
                        <div class="card-body">
                            <div class="card border-0">
                                <div class="card-body p-0">
                                    <div class="row align-items-center">
                                        <div class="col-10">
                                            <div class="custom-control custom-radio d-flex align-items-center small">
                                                <input type="radio" class="custom-control-input" id="boleto" name="boleto" value="boleto" v-model="form_payment">
                                                <label class="custom-control-label ml-1" for="boleto">
                                                    <span class="d-block font-size-1 font-weight-medium mb-1">Boleto</span>
                                                    <span class="d-block text-muted">Shipment may take 5-6 business days.</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2 text-muted">
                                            <i class="fas fa-barcode fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <component :is="component" @submit="submitForm"/>
            </div>
        </div>
    </form>
</template>

<script>
    import moment from 'moment'
    import swal from 'sweetalert2'

    import UpdatingUserData from './partials/UpdatingUserData'
    import Boleto from './partials/Boleto'
    import CreditCard from './partials/CreditCard'
    import LocalStorage from "../../../vendor/storage"

    import {mapActions, mapState} from 'vuex'
    import {sendAPIPOST, toSeek} from "../../../vendor/common";
    import {createCardHash} from "../../../vendor/api";

    export default {
        name: "Payment",
        $_veeValidate: {
            validator: 'new'
        },
        components: {
            UpdatingUserData,
            Boleto,
            CreditCard
        },
        data: () => ({
            form_payment: 'credit_card',
            component: 'credit-card',
            hash: null,
            customer: {
                document: '',
                phone: ''
            },
            callback: 'conclusion'
        }),
        watch: {
            form_payment(value) {
                let arr = {
                    credit_card: 'credit-card',
                    boleto: 'boleto'
                }

                this.component = arr[value]
            }
        },
        computed: {
            ...mapState({
                cart: state => state.cart,
                user: state => state.user.attributes
            }),
            checkDocument() {
                return _.isEmpty(this.user.document)
            }
        },
        methods: {
            ...mapActions(['changeLoading', 'changeCart']),
            conclusionCart() {
                this.changeLoading(true)

                this.$router.push({name: 'conclusion'})
            },
            async submitForm(data) {
                this.changeLoading(true)

                if (!this.hash) {
                    this.changeLoading(false)

                    return
                }

                data.hash = this.hash
                data.type = this.form_payment
                data._method = 'PATCH'
                data.callback = this.callback
                if (!this.user.document) data.customer = this.customer

                await sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/carts/${this.cart.id}/payment`, data).then(
                    async response => {
                        await this.changeCart(response.data.data)

                        new LocalStorage('cart__').setItem('user', response.data.data, moment(response.data.data.attributes.expires_at).diff(moment(), 'seconds'))

                        this.$router.push({name: 'conclusion'})
                    }
                ).catch(
                    (error) => {
                        this.changeLoading(false)

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
                )
            }
        },
        mounted() {
            toSeek(`${process.env.MIX_API_PAYMENT}/api/session`).then(
                async response => {
                    await PagSeguroDirectPayment.setSessionId(response.session)
                    await createCardHash().then((response) => this.hash = response).catch((error) => this.setError(error))
                }
            )
        }
    }
</script>
