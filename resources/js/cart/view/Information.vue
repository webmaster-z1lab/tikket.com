<template>
    <form>
        <div class="row" v-for="(ticket, index) in cart.tickets">
            <div class="col-12 mb-3">
                <h2 class="h5 mb-0">Ingresso nº {{++index}}</h2>
                <p>{{ticket.input}} {{ticket.lot ? `Lote - ${ticket.lot}` : '' }}</p>
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
                <div class="js-form-message mb-6" :class="errors.has(`cpf-${index}`) ? 'u-has-error' : ''">
                    <label class="form-label">
                        CPF <span class="text-danger">*</span>
                    </label>

                    <the-mask class="form-control u-form__input" type="text" :name="`cpf-${index}`" id="cpf"
                              placeholder="000.000.000-00" v-validate="'required|cpf'" data-vv-as="'CPF'" mask="###.###.###-##" v-model="ticket.cpf">
                    </the-mask>

                    <div v-show="errors.has(`cpf-${index}`)" class="invalid-feedback" style="display: block">
                        {{ errors.first(`cpf-${index}`) }}
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
            <router-link :to="{name: 'payment'}" class="btn btn-primary transition-3d-hover">
                Continuar
            </router-link>
        </div>
    </form>
</template>

<script>
    import LoadingComponent from '../../components/loadingComponent'

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
            searchCompanies() {
                this.searchCompany = false

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        Pace.start()
                        this.isLoading = true

                        this.companies = sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/actions/search/google`, {
                            city: this.city,
                            place: this.keyword
                        }).then(
                            async result => {
                                this.companies = await result.data.data
                                this.searchCompany = true
                            }
                        ).catch(
                            (error) => {
                                if (_.isObject(error.response)) {
                                    toast({
                                        type: 'error',
                                        title: error.response.data.errors.detail
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
                })
            },
            submitCompany(placeID) {
                Pace.start()
                this.isLoading = true

                let planID = window.location.pathname.split('/')[2]
                let callback = _.isEmpty(this.user.document) ? 'profile_registration' : 'payment'

                sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/carts`, {google_place_id: placeID, plan_id: planID, callback: callback}).then(
                    result => {
                        this.changeCart(result.data.data)
                        this.$router.push({name: callback})
                    }
                ).catch(
                    (error) => {
                        if (_.isObject(error.response)) {
                            toast({
                                type: 'error',
                                title: error.response.data.errors.detail
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
            },
            setLocation(value) {
                this.city = value
            }
        }
    }
</script>
