<template>
    <div class="col-12">
        <div class="card card-frame card-frame-highlighted mb-4">
            <div class="card-body">
                <h5 class="card-title">Pagamento por Boleto</h5>

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Informações sobre o Boleto</h4>
                    <p class="alert-text">Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr />
                    <p class="alert-text mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div>

                <data-address :data="address" v-if="checkAddress"/>
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
    import DataAddress from "./DataAddress"

    import {mapState} from 'vuex'

    export default {
        name: "Boleto",
        inject: ['$validator'],
        components: {
            DataAddress
        },
        data: () => ({
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
                user: state => state.user.attributes
            }),
            checkAddress() {
                return _.isEmpty(this.user.address)
            }
        },
        methods: {
            conclusionPayment() {
                this.$validator.validateAll().then(
                    async res => {
                        if (res) {
                            let data = {}

                            if (this.checkAddress) data.address = this.address

                            this.$emit('submit', data)
                        }
                    }
                )
            }
        }
    }
</script>
