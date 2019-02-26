<template>
    <div class="d-lg-flex">
        <loading-component :is-loading="isLoading"></loading-component>

        <component :is="layout" @loading="loading">
            <router-view @loading="loading" v-if="!isLoading"/>
        </component>
    </div>
</template>

<script>
    import LoadingComponent from '../components/loadingComponent'
    import LocalStorage from "../vendor/storage"

    import LayoutDefault from "./components/layouts/default"
    import LayoutError from "./components/layouts/error"

    import moment from "moment"

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
            '$route': 'fetchData'
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
                if (this.$route.meta.layout === "error") {
                    this.loading(false)

                    return;
                }

                let cartLS = new LocalStorage('cart__').getItem('user')

                toSeek(route('openid.user')).then(
                    async response => {
                        await this.setUser(response.data)
                    }
                );

                if (cartLS) {
                    this.changeCart(cartLS)

                    this.loading(false)
                } else {
                    toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/carts`).then(async response => {
                        if (!_.isEmpty(response.data)) {
                            await this.changeCart(response.data)
                            new LocalStorage('cart__').setItem('user', response.data, moment(response.data.attributes.expires_at).diff(moment(), 'seconds'))

                            this.loading(false)
                            this.$router.push({name: response.data.attributes.callback})
                        } else {
                            this.loading(false)
                            this.$router.push({name: 'information'})
                        }
                    }).catch((error) => {
                        this.$router.push({name: "error", params: {code: error.response.status}})
                    })
                }
            },
            loading(value) {
                this.isLoading = value
            }
        }
    }
</script>
