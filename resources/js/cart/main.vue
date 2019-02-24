<template>
    <div class="d-lg-flex">
        <loading-component :is-loading="isLoading"></loading-component>

        <component :is="layout" @loading="loading">
            <router-view @loading="loading" :is-loading="!isLoading"/>
        </component>
    </div>
</template>

<script>
    import LoadingComponent from '../components/loadingComponent'
    import LocalStorage from "../vendor/storage"

    import LayoutDefault from "./components/layouts/default"
    import LayoutError from "./components/layouts/error"

    import swal from 'sweetalert2'
    import moment from 'moment'

    import {mapActions} from 'vuex'
    import {toSeek} from "../vendor/common";

    export default {
        name: 'VueMain',
        components: {
            LoadingComponent,
            LayoutDefault,
            LayoutError
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
            layout() {
                return `layout-${(this.$route.meta.layout || 'default')}`
            }
        },
        data: () => ({
            isLoading: true
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

                    this.seconds = moment(this.cart.attributes.expires_at).diff(moment(), 'seconds')

                    this.stopTime = false
                    this.isLoading = false
                } else {
                    this.pageError = true
                    this.isLoading = false
                }
            },
            loading(value) {
                this.isLoading = value
                value ? Pace.start() : Pace.stop()
            }
        }
    }
</script>
