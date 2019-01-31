<template>
    <div class="d-lg-flex">
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="container space-3" v-if="!pageError">
            <div class="row">
                <div class="col-lg-4 order-lg-2 mb-9 mb-lg-0">
                    <div class="mb-4">
                        <h2 class="h5">Dados da Compra</h2>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <div class="media align-items-center mb-5" v-for="ticket in groupTickets">
                                <div class="u-avatar position-relative mr-3">
                                    <button type="button" class="btn btn-icon btn-soft-primary rounded-circle transition-3d-hover mb-1">
                                        <span class="fas fa-ticket-alt"></span>
                                    </button>
                                    <span class="badge badge-sm badge-primary badge-pos rounded-circle">{{ticket.length}}</span>
                                </div>
                                <div class="media-body">
                                    <h2 class="h6 mb-0">{{ticket[0].input}}</h2>
                                    <small class="d-block text-secondary">{{ticket[0].lot ? `Lote - ${ticket[0].lot}` : '' }}</small>
                                </div>
                                <div class="media-body text-right">
                                    <span>{{(ticket[0].value / 100) | currency}}</span>
                                </div>
                            </div>

                            <hr class="mb-5">

                            <form class="js-validate" novalidate="novalidate">
                                <label class="sr-only" for="discountSrEmail">Cupom</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="discountSrEmail" placeholder="Cupom" aria-label="Discount" aria-describedby="discountEmailButton">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" id="discountEmailButton">Aplicar</button>
                                    </div>
                                </div>
                            </form>

                            <hr class="my-5">

                            <div class="media align-items-center">
                                <h3 class="h6 text-secondary mr-3">Subtotal</h3>
                                <div class="media-body text-right">
                                    <span>{{(cart.value / 100) | currency}}</span>
                                </div>
                            </div>

                            <div class="media align-items-center">
                                <h3 class="h6 text-secondary mr-3">Desconto</h3>
                                <div class="media-body text-right">
                                    <span>-{{(cart.coupon.total_discount / 100) | currency}}</span>
                                </div>
                            </div>

                            <hr class="my-5">

                            <div class="media align-items-center">
                                <h3 class="h6 text-secondary mr-3">Total</h3>
                                <div class="media-body text-right">
                                    <span class="font-weight-semi-bold">{{(cart.amount / 100) | currency}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 order-lg-1">
                    <form class="js-step-form">
                        <nav id="progressStepForm"
                             class="js-step-progress nav nav-icon nav-justified text-center">
                            <a href="javascript:;" class="nav-item u-checked"
                               v-for="(item, key, index) in menu_form" :class="classActive(key, index)">
                                <span class="nav-icon-action" v-html="item.icon"></span>
                                {{key}}
                            </a>
                        </nav>
                    </form>
                    <hr class="my-5">

                    <router-view v-if="!isLoading"></router-view>
                </div>
            </div>
        </div>

        <router-view v-if="pageError && !isLoading"></router-view>
    </div>
</template>

<style>
    .nav-icon .nav-item.confirm {
        color: #00c9a7;
    }

    .nav-icon .nav-item.confirm .nav-icon-action {
        color: #fff;
        background-color: #00c9a7;
    }
</style>

<script>
    import LoadingComponent from '../components/loadingComponent'

    import {mapActions, mapState} from 'vuex'
    import {toSeek} from "../vendor/common";

    export default {
        name: 'VueMain',
        components: {
            LoadingComponent
        },
        watch: {
            //'$route': 'fetchData'
        },
        computed: {
            ...mapState({
                cart: state => state.cart
            }),
            groupTickets(){
                return _.groupBy(this.cart.tickets, 'id')
            }
        },
        data: () => ({
            isLoading: true,
            pageError: false,
            key_active: null,
            menu_form: {
                'Informações': {
                    icon: '<span class="fas fa-file-signature nav-icon-action-inner" style="padding-left: 5px"></span>',
                    routes: ['information']
                },
                'Pagamento': {
                    icon: '<span class="fas fa-money-bill-alt nav-icon-action-inner"></span>',
                    routes: ['payment']
                },
                'Concluído': {
                    icon: '<span class="fas fa-check-circle nav-icon-action-inner"></span>',
                    routes: ['conclusion']
                }
            }
        }),
        created () {
            this.fetchData()
        },
        methods: {
            ...mapActions(['setCart', 'setUser']),
            fetchData () {
                console.log('test main')
                if (this.$route.name !== 'page_not_found'){
                    //toSeek(route('openid.user')).then(async response => this.setUser(response));

                    // toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/carts/actions/search`).then( async response => {
                    //     if (!_.isEmpty(response.data)) {
                    //         await this.setCart(response.data)
                    //
                    //         this.isLoading = false
                    //         this.$router.push({name: response.data.attributes.callback})
                    //     } else {
                    //         this.isLoading = false
                    //         this.$router.push({name: 'place'})
                    //     }
                    // })
                    this.isLoading = false
                } else {
                    this.pageError = true
                    this.isLoading = false
                }
            },
            classActive(name, key) {
                let active = collect(this.menu_form[name].routes).filter((value, key) => value === this.$route.name).all()

                if (!_.isEmpty(active)) {
                    this.key_active = key

                    return 'active'
                }

                return key < this.key_active ? 'confirm' : ''
            }
        }
    }
</script>
