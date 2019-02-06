<template>
    <div class="d-lg-flex">
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="container space-1 space-sm-3" v-if="!pageError">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-primary text-center" role="alert">
                        <p class="h6">Tempo para finalizar a compra:</p>
                        <p class="h5">{{ timer }}</p>

                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                 role="progressbar" aria-valuemin="0"
                                 aria-valuemax="100"
                                 :style="{width: percent + '%'}"
                                 :class=percent_class
                                 :aria-valuenow="percent"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 order-lg-2 mb-9 mb-lg-0">
                    <div class="mb-4">
                        <h2 class="h5">Dados da Compra</h2>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <div class="media align-items-center mb-5" v-for="ticket in groupTickets">
                                <div class="u-avatar position-relative mr-3">
                                    <button type="button" class="btn btn-icon btn-soft-primary rounded-circle mb-1">
                                        <span class="fas fa-ticket-alt"></span>
                                    </button>
                                    <span class="badge badge-sm badge-primary badge-pos rounded-circle">{{ticket.length}}</span>
                                </div>
                                <div class="media-body">
                                    <h2 class="h6 mb-0">{{ticket[0].entrance}}</h2>
                                    <small class="d-block text-secondary">{{ticket[0].lot ? `Lote - ${ticket[0].lot}` : '' }} (+ {{(ticket[0].fee / 100) | currency}} taxa)</small>
                                </div>
                                <div class="media-body text-right">
                                    <span>{{(ticket[0].price / 100) | currency}}</span>
                                </div>
                            </div>

                            <hr class="mb-5">

                            <form class="js-validate" novalidate="novalidate">
                                <label class="sr-only" for="discountSrEmail">Cupom</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="discountSrEmail" placeholder="Cupom" aria-label="Discount"
                                           aria-describedby="discountEmailButton">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" id="discountEmailButton">Aplicar</button>
                                    </div>
                                </div>
                            </form>

                            <hr class="my-5">

                            <div class="media align-items-center">
                                <h3 class="h6 text-secondary mr-3">Subtotal</h3>
                                <div class="media-body text-right">
                                    <span>{{((cart.attributes.amount + cart.attributes.fee) / 100) | currency}}</span>
                                </div>
                            </div>

                            <div class="media align-items-center">
                                <h3 class="h6 text-secondary mr-3">Desconto</h3>
                                <div class="media-body text-right">
                                    <span>-{{(cart.attributes.discount / 100) | currency}}</span>
                                </div>
                            </div>

                            <hr class="my-5">

                            <div class="media align-items-center">
                                <h3 class="h6 text-secondary mr-3">Total</h3>
                                <div class="media-body text-right">
                                    <span class="font-weight-semi-bold">{{((cart.attributes.amount + cart.attributes.fee - cart.attributes.discount) / 100) | currency}}</span>
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
                                {{ item.label }}
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
        color : #00C9A7;
    }

    .nav-icon .nav-item.confirm .nav-icon-action {
        color            : #FFFFFF;
        background-color : #00C9A7;
    }
</style>

<script>
    import LoadingComponent from '../components/loadingComponent'
    import LocalStorage from "../vendor/storage"
    import swal from 'sweetalert2'
    import moment from 'moment'

    import {mapActions, mapState} from 'vuex'
    import {toSeek} from "../vendor/common";

    export default {
        name: 'VueMain',
        components: {
            LoadingComponent
        },
        watch: {
            '$route': 'fetchData',
            seconds(value) {
                if (value <= 0) {
                    swal({
                        title: 'O tempo para a compra expirou',
                        text: 'Isso é necessário para que uma reserva não fique presa e possa estar disponível para compra novamente.',
                        type: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#6000a7',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Comprar novamente',
                        cancelButtonText: 'Voltar a home'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = route('event', this.cart.relationships.event.attributes.url)
                        } else {
                            window.location.href = route('home')
                        }
                    })
                }
            }
        },
        computed: {
            ...mapState({
                cart: state => state.cart
            }),
            groupTickets() {
                return _.groupBy(this.cart.attributes.tickets, 'id')
            }
        },
        data: () => ({
            stopTime: true,
            timer: '15:00',
            percent: 100,
            percent_class: '',
            seconds: 0,
            time_begin: '',
            isLoading: true,
            pageError: false,
            key_active: null,
            menu_form: {
                'information': {
                    label: 'Informações',
                    icon: '<span class="fas fa-file-signature nav-icon-action-inner" style="padding-left: 5px"></span>',
                    routes: ['information']
                },
                'payment': {
                    label: 'Pagamento',
                    icon: '<span class="fas fa-money-bill-alt nav-icon-action-inner"></span>',
                    routes: ['payment']
                },
                'conclusion': {
                    label: 'Concluído',
                    icon: '<span class="fas fa-check-circle nav-icon-action-inner"></span>',
                    routes: ['conclusion']
                }
            }
        }),
        created() {
            this.fetchData()
        },
        methods: {
            ...mapActions(['changeCart', 'setUser']),
            fetchData() {
                if (this.$route.name !== 'page_not_found') {
                    let cartLS = new LocalStorage('cart__').getItem('user')

                    toSeek(route('openid.user')).then(
                        async response => {
                            await this.setUser(response.data)
                        }
                    );

                    if (cartLS) {
                        this.changeCart(cartLS)
                    } else {
                        toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/carts`).then(async response => {
                            if (!_.isEmpty(response.data)) {
                                await this.changeCart(response.data)
                                new LocalStorage('cart__').setItem('user', response.data, response.data.attributes.expires_at)

                                this.isLoading = false
                                this.$router.push({name: response.data.attributes.callback})
                            } else {
                                this.isLoading = false
                                this.$router.push({name: 'information'})
                            }
                        })
                    }

                    this.seconds = moment(this.cart.attributes.expires_at).diff(moment(),'seconds')

                    this.stopTime = false
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
        },
        mounted() {
            const timeDurationToString = (duration) => {
                return duration > 9 ? duration : '0' + duration
            }

            const tick = () => {
                if (this.stopTime || this.seconds <= 0) return
                this.seconds -= 1
                const minutesLeft = Math.floor(this.seconds / 60)
                const secondsLeft = this.seconds % 60
                this.timer = `${timeDurationToString(minutesLeft)}:${timeDurationToString(secondsLeft)}`

                this.percent = this.seconds * 100 / (15 * 60)

                if (this.percent <= 50 && this.percent > 25) {
                    this.percent_class = 'warning'
                } else if (this.percent <= 25) {
                    this.percent_class = 'danger'
                }
            }

            setInterval(tick, 1000)
        }
    }
</script>
