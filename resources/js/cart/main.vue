<template>
    <div class="d-lg-flex">
        <loading-component :is-loading="isLoading"></loading-component>

        <component :is="layout">
            <router-view/>
        </component>
    </div>
</template>

<script>
    import LoadingComponent from '../components/loadingComponent'
    import LocalStorage from "../vendor/storage"

    import LayoutDefault from "./components/layouts/default"
    import LayoutError from "./components/layouts/error"
    import LayoutInvoice from "./components/layouts/invoice"

    import moment from "moment"

    import {mapActions, mapState} from 'vuex'
    import {toSeek} from "../vendor/common";

    export default {
        name: 'VueMain',
        components: {
            LoadingComponent,
            LayoutDefault,
            LayoutError,
            LayoutInvoice
        },
        watch: {
            '$route': 'fetchData'
        },
        computed: {
            ...mapState({
                isLoading: state => state.isLoading
            }),
            layout() {
                return `layout-${(this.$route.meta.layout || 'default')}`
            }
        },
        created() {
            this.fetchData()
        },
        methods: {
            ...mapActions(['changeCart', 'setUser', 'changeLoading']),
            fetchData() {
                if (this.$route.meta.layout === "error") {
                    this.changeLoading(false)

                    return;
                }

                let cartLS = new LocalStorage('cart__').getItem('user')

                toSeek(route('openid.user')).then(
                    async response => {
                        await this.setUser(response.data)
                    }
                )

                if (cartLS) {
                    this.changeCart(cartLS)
                    this.changeLoading(false)
                } else {
                    toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/carts`).then(async response => {
                        if (!_.isEmpty(response.data)) {
                            await this.changeCart(response.data)
                            new LocalStorage('cart__').setItem('user', response.data, moment(response.data.attributes.expires_at).diff(moment(), 'seconds'))

                            console.log(response.data.attributes.callback)
                            this.changeLoading(false)
                            this.$router.push({name: response.data.attributes.callback})
                        } else {
                            this.changeLoading(false)
                            this.$router.push({name: 'information'})
                        }
                    }).catch((error) => {
                        let title = error.response.data.errors ? error.response.data.errors.title : '',
                            message = error.response.data.errors ? error.response.data.errors.detail : error.response.data.message

                        this.$router.push({name: "error", params: {code: error.response.status, title: title, message: message}})
                    })
                }
            }
        }
    }
</script>
