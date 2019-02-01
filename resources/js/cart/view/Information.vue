<template>
    <form>
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="row" v-for="(ticket, index) in cart.attributes.tickets">
            <div class="col-12 mb-3">
                <h2 class="h5 mb-0">Ingresso nº {{++index}}</h2>
                <p>{{ticket.entrance}} {{ticket.lot ? `Lote - ${ticket.lot}` : '' }}</p>
            </div>

            <div class="col-md-6">
                <div class="js-form-message mb-6" :class="errors.has(`name-${index}`) ? 'u-has-error' : ''">
                    <label class="form-label">
                        Nome <span class="text-danger">*</span>
                    </label>

                    <input type="text" class="form-control" :name="`name-${index}`" placeholder="Nome no Ingresso" v-model="ticket.name"
                           v-validate="'required'" data-vv-as="'Nome'">

                    <div v-show="errors.has(`name-${index}`)" class="invalid-feedback" style="display: block">
                        {{ errors.first(`name-${index}`) }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="js-form-message mb-6" :class="errors.has(`document-${index}`) ? 'u-has-error' : ''">
                    <label class="form-label">
                        CPF <span class="text-danger">*</span>
                    </label>

                    <the-mask class="form-control u-form__input" type="text" :name="`document-${index}`" id="cpf"
                              placeholder="000.000.000-00" v-validate="'required|cpf'" data-vv-as="'CPF'" mask="###.###.###-##" v-model="ticket.document">
                    </the-mask>

                    <div v-show="errors.has(`document-${index}`)" class="invalid-feedback" style="display: block">
                        {{ errors.first(`document-${index}`) }}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="js-form-message mb-6" :class="errors.has(`email-${index}`) ? 'u-has-error' : ''">
                    <label class="form-label">
                        Email <span class="text-danger">*</span>
                    </label>

                    <input type="email" class="form-control" :name="`email-${index}`" placeholder="jackwayley@gmail.com"
                           v-model="ticket.email" v-validate="'required|email'" data-vv-as="'Email'">

                    <div v-show="errors.has(`email-${index}`)" class="invalid-feedback" style="display: block">
                        {{ errors.first(`email-${index}`) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="/" class="btn btn-soft-secondary transition-3d-hover">
                Voltar a Home
            </a>
            <button type="button" class="btn btn-primary transition-3d-hover" @click="submitTickets">
                Continuar
            </button>
        </div>
    </form>
</template>

<script>
    import LoadingComponent from '../../components/loadingComponent'
    import LocalStorage from "../../vendor/storage"
    import swal from 'sweetalert2'

    import {TheMask} from 'vue-the-mask'
    import {mapActions, mapState} from 'vuex'
    import {sendAPIPOST} from "../../vendor/common";

    export default {
        name: "Information",
        $_veeValidate: {
            validator: 'new'
        },
        components: {
            LoadingComponent,
            TheMask
        },
        data: () => ({
            isLoading: false
        }),
        computed: {
            ...mapState({
                cart: state => state.cart
            })
        },
        methods: {
            ...mapActions(['changeCart']),
            submitTickets() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            Pace.start()
                            this.isLoading = true

                            let data = {
                                callback: "payment",
                                tickets: this.cart.attributes.tickets,
                                _method: 'PATCH'
                            }

                            await sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/carts/${this.cart.id}/tickets`, data).then(
                                async response => {
                                    await this.changeCart(response.data.data)
                                    new LocalStorage('cart__').setItem('user', response.data.data, response.data.data.attributes.expires_at)

                                    this.$router.push({name: 'payment'})
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
            }
        }
    }
</script>
