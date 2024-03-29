<template>
    <form>
        <div class="alert alert-primary" role="alert">
            <h5 class="alert-heading">Defina para cada ingresso os dados de seu titular</h5>
            <hr>
            <p class="alert-text mb-0">
                Esses informações serão conferidas na portaria do evento e são exigidas para garantir a segurança e autenticidade dos seus ingressos.
            </p>
        </div>

        <div class="card card-frame card-frame-highlighted mb-4" v-for="(ticket, index) in cart.attributes.tickets">
            <div class="card-body">
                <h5 class="card-title">Ingresso nº {{ index + 1 }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ ticket.entrance }} - {{ ticket.lot ? `Lote ${ticket.lot}` : '' }}</h6>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="js-form-message" :class="errors.has(`name-${index}`) ? 'u-has-error' : ''">
                            <label class="form-label required">Titular</label>

                            <input type="text" class="form-control" :name="`name-${index}`" placeholder="Nome no Ingresso" v-model="ticket.name"
                                   v-validate="'required'" data-vv-as="'Nome'">

                            <div v-show="errors.has(`name-${index}`)" class="invalid-feedback" style="display: block">
                                {{ errors.first(`name-${index}`) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <div class="js-form-message" :class="errors.has(`document-${index}`) ? 'u-has-error' : ''">
                            <label class="form-label required">CPF</label>

                            <the-mask class="form-control u-form__input" type="text" :name="`document-${index}`" id="cpf"
                                      placeholder="000.000.000-00" v-validate="'required|cpf'" data-vv-as="'CPF'" mask="###.###.###-##" v-model="ticket.document">
                            </the-mask>

                            <div v-show="errors.has(`document-${index}`)" class="invalid-feedback" style="display: block">
                                {{ errors.first(`document-${index}`) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="js-form-message" :class="errors.has(`email-${index}`) ? 'u-has-error' : ''">
                            <label class="form-label required">Email</label>

                            <input type="email" class="form-control" :name="`email-${index}`" placeholder="jackwayley@gmail.com"
                                   v-model="ticket.email" v-validate="'required|email'" data-vv-as="'Email'">

                            <div v-show="errors.has(`email-${index}`)" class="invalid-feedback" style="display: block">
                                {{ errors.first(`email-${index}`) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a :href="'/evento/' + cart.relationships.event.attributes.url" class="btn btn-secondary btn-wide transition-3d-hover">
                <i class="fas fa-home mr-1"></i> Cancelar
            </a>
            <button type="button" class="btn btn-primary btn-wide transition-3d-hover" @click="submitTickets">
                <span v-if="!cart.is_free">Continuar <i class="fas fa-money-bill-alt ml-1"></i></span>
                <span v-else>Concluir <i class="fas fa-check-circle ml-1"></i></span>
            </button>
        </div>
    </form>
</template>

<script>
    import LocalStorage from "../../../vendor/storage"
    import swal from 'sweetalert2'
    import moment from 'moment'

    import {TheMask} from 'vue-the-mask'
    import {mapActions, mapState} from 'vuex'
    import {sendAPIPOST} from "../../../vendor/common";

    export default {
        name: "Information",
        $_veeValidate: {
            validator: 'new'
        },
        components: {
            TheMask
        },
        computed: {
            ...mapState({
                cart: state => state.cart
            }),
        },
        methods: {
            ...mapActions(['changeCart', 'changeLoading']),
            submitTickets() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            this.changeLoading(true)

                            let data = {
                                callback: "payment",
                                tickets: this.cart.attributes.tickets,
                                _method: 'PATCH'
                            }

                            await sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/carts/${this.cart.id}/tickets`, data).then(
                                async response => {
                                    this.changeLoading(false)

                                    await this.changeCart(response.data.data)
                                    new LocalStorage('cart__').setItem('user', response.data.data, moment(response.data.data.attributes.expires_at).diff(moment(), 'seconds'))

                                    if (this.cart.is_free) {
                                        this.$router.push({name: 'conclusion'})
                                    } else {
                                        this.$router.push({name: 'payment'})
                                    }
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
                    }
                )
            }
        }
    }
</script>
