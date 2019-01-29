<template>
    <div>
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="bg-light">
            <div class="container space-1">
                <div class="text-xl-right">
                    <div class="btn-group btn-group-toggle bg-white">
                        <button type="button" class="btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide"
                                :class="active_signatures ? 'active' : ''" @click="setList('active')">
                            Ativas
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-custom-toggle-primary btn-sm-wide"
                                :class="historic_signatures ? 'active' : ''" @click="setList('historic')">
                            Histórico
                        </button>
                    </div>
                </div>
            </div>

            <div class="container space-2" style="padding-top: 0!important;">
                <div v-show="active_signatures">
                    <div class="text-center m-9" v-if="activesCheck">
                        <figure class="w-65 mx-auto mb-4">
                            <img class="w-50" src="https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/create-account.svg" alt="SVG">
                        </figure>

                        <div class="mb-4">
                            <h1 class="h3"><strong>Nenhuma assinatura foi encontrado.</strong></h1>

                            <p>Venha exibir sua loja para as outras pessoas, confira nossos planos e assine agora
                                mesmo.</p>
                        </div>

                        <a :href="routePlans" class="btn btn-sm u-btn-primary--air u-btn-wide transition-3d-hover">
                            Confirir planos
                            <span class="fa fa-angle-right ml-2"></span>
                        </a>
                    </div>

                    <div v-else>
                        <div class="mb-3">
                            <h2 class="h5 mb-0">Lista de Assinaturas</h2>
                        </div>

                        <div id="activeDetails" class="accordion">
                            <div class="card" v-for="(sign, key) in actives">
                                <div class="card-header card-collapse" :id="`card-active-${key}`">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link btn-block card-btn collapsed p-3" role="button"
                                                data-toggle="collapse"
                                                :data-target="`#cardActive-${key}`"
                                                aria-expanded="false"
                                                :aria-controls="`cardActive-${key}`">
                                <span class="row align-items-center">
                                  <span class="col-md-6 mb-2 mb-md-0">
                                    <span class="media align-items-center">
                                      <figure>
                                          <img class="w-50 d-none d-sm-block" src="https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/icons/icon-2.svg"
                                               alt="SVG">
                                      </figure>
                                      <span class="media-body">
                                        <span class="font-size-1">{{sign.relationships.place.attributes.name}}</span>
                                      </span>
                                    </span>
                                  </span>
                                  <span class="col-4 col-md-2 text-md-right">
                                    <span class="u-label u-label--sm"
                                          :class="translateStatus(sign.attributes.status).class_color">
                                        {{translateStatus(sign.attributes.status).name}}
                                    </span>
                                  </span>
                                  <span class="col-6 col-md-3">
                                      <span
                                          class="d-block font-size-1">Data de adesão: {{sign.attributes.created_at}}</span>
                                  </span>
                                  <span class="col-2 col-md-1 text-right">
                                    <span class="card-btn-arrow">
                                      <span class="fas fa-arrow-down small"></span>
                                    </span>
                                  </span>
                                </span>
                                        </button>
                                    </h5>
                                </div>
                                <div :id="`cardActive-${key}`" class="collapse" :aria-labelledby="`card-active-${key}`"
                                     data-parent="#activeDetails">
                                    <div class="card-body px-4">
                                        <div class="row">
                                            <div class="col-sm-7 mb-2 mb-sm-0">
                                                <h4 class="h6 mb-1">{{sign.relationships.place.attributes.name}}</h4>
                                                <span class="d-block font-size-1 mb-1">{{sign.relationships.place.relationships.address.attributes.formatted}}</span>
                                            </div>
                                            <div class="col-sm-5 mb-2 mb-sm-0">
                                                <h5 class="h6 mb-0">Dados do Pagamento</h5>
                                                <h6 class="h7">{{namePayment(sign)}}</h6>
                                                <address class="font-size-1">
                                                    Endereço: {{addressPayment(sign)}}
                                                </address>
                                                <p class="font-size-1">
                                                    Número do Cartão: {{sign.relationships.card.attributes.number}}
                                                </p>
                                                <p class="font-size-1 text-uppercase">
                                                    Bandeira: {{sign.relationships.card.attributes.brand}}
                                                </p>

                                                <button type="button" class="btn btn-xs btn-soft-secondary mr-1"
                                                        v-if="checkCancel(sign.attributes)"
                                                        @click="cancelSign(sign.attributes)">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-show="historic_signatures">
                    <div class="text-center m-9" v-if="historicalCheck">
                        <figure class="w-65 mx-auto mb-4">
                            <img class="w-50" src="https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/create-account.svg" alt="SVG">
                        </figure>

                        <div class="mb-4">
                            <h1 class="h3"><strong>Nada no seu hitórico de assinatura.</strong></h1>
                        </div>

                        <a href="javascript:;" @click="setList('active')"
                                class="btn btn-sm u-btn-primary--air u-btn-wide transition-3d-hover">
                            Voltar para às assinaturas ativas
                            <span class="fa fa-angle-right ml-2"></span>
                        </a>
                    </div>

                    <div v-else>
                        <div class="mb-3">
                            <h2 class="h5 mb-0">Histórico de Assinaturas</h2>
                        </div>

                        <div id="historicDetails" class="accordion">
                            <div class="card" v-for="(sign, key) in historical">
                                <div class="card-header card-collapse" :id="`card-historic-${key}`">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link btn-block card-btn collapsed p-3" role="button"
                                                data-toggle="collapse"
                                                :data-target="`#cardHistoric-${key}`"
                                                aria-expanded="false"
                                                :aria-controls="`cardHistoric-${key}`">
                                <span class="row align-items-center">
                                  <span class="col-md-6 mb-2 mb-md-0">
                                    <span class="media align-items-center">
                                      <figure>
                                          <img class="w-50 d-none d-sm-block" src="https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/icons/icon-2.svg"
                                               alt="SVG">
                                      </figure>
                                      <span class="media-body">
                                        <span class="font-size-1">{{sign.relationships.place.attributes.name}}</span>
                                      </span>
                                    </span>
                                  </span>
                                  <span class="col-4 col-md-2 text-md-right">
                                    <span class="u-label u-label--sm"
                                          :class="translateStatus(sign.attributes.status).class_color">
                                        {{translateStatus(sign.attributes.status).name}}
                                    </span>
                                  </span>
                                  <span class="col-6 col-md-3">
                                      <span
                                          class="d-block font-size-1">Data de adesão: {{sign.attributes.created_at}}</span>
                                  </span>
                                  <span class="col-2 col-md-1 text-right">
                                    <span class="card-btn-arrow">
                                      <span class="fas fa-arrow-down small"></span>
                                    </span>
                                  </span>
                                </span>
                                        </button>
                                    </h5>
                                </div>
                                <div :id="`cardHistoric-${key}`" class="collapse"
                                     :aria-labelledby="`card-historic-${key}`" data-parent="#historicDetails">
                                    <div class="card-body px-4">
                                        <div class="row">
                                            <div class="col-sm-7 mb-2 mb-sm-0">
                                                <h4 class="h6 mb-1">{{sign.relationships.place.attributes.name}}</h4>
                                                <span class="d-block font-size-1 mb-1">{{sign.relationships.place.relationships.address.attributes.formatted}}</span>
                                            </div>
                                            <div class="col-sm-5 mb-2 mb-sm-0">
                                                <h5 class="h6 mb-0">Dados do Pagamento</h5>
                                                <h6 class="h7">{{namePayment(sign)}}</h6>
                                                <address class="font-size-1">
                                                    Endereço: {{addressPayment(sign)}}
                                                </address>
                                                <p class="font-size-1">
                                                    Número do Cartão: {{sign.relationships.card.attributes.number}}
                                                </p>
                                                <p class="font-size-1 text-uppercase">
                                                    Bandeira: {{sign.relationships.card.attributes.brand}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LoadingComponent from '../../components/loadingComponent'
    import swal from 'sweetalert2'

    import {mapState} from 'vuex'
    import {toSeek, sendAPIDELETE} from "../../vendor/common";

    export default {
        name: "MySubscriptions",
        data: () => ({
            isLoading: true,
            actives: {},
            historical: {},
            active_signatures: true,
            historic_signatures: false
        }),
        components: {
            LoadingComponent
        },
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes,
                address: state => state.dataBasic.data.relationships.address.data.attributes
            }),
            routePlans() {
                return route('plans')
            },
            activesCheck() {
                return _.isEmpty(this.actives)
            },
            historicalCheck() {
                return _.isEmpty(this.historical)
            }
        },
        methods: {
            translateStatus(status) {
                const translate = {
                    'waiting': {
                        name: 'Aguardando',
                        class_color: 'u-label--primary'
                    },
                    'active': {
                        name: 'Ativa',
                        class_color: 'u-label--success'
                    },
                    'suspended': {
                        name: 'Suspensa',
                        class_color: 'u-label--warning'
                    },
                    'canceled': {
                        name: 'Cancelado',
                        class_color: 'u-label--danger'
                    },
                    'needs update payment method': {
                        name: 'Cartão Desatualizado',
                        class_color: 'u-label--warning'
                    },
                    'unknown': {
                        name: 'Sei lá oque é',
                        class_color: 'u-label--warning'
                    }
                }

                return translate[status]
            },
            namePayment(sign) {
                return sign.relationships.card.attributes.from_user ? this.user.name : 'Cartão de Terceiro'
            },
            addressPayment(sign) {
                return sign.relationships.card.attributes.from_user ? this.address.formatted : 'Informação oculta por segurança'
            },
            checkCancel(sign) {
                return !_.isEmpty(sign.signature_id)
            },
            setList(list) {
                if (list === 'active') {
                    this.active_signatures = true
                    this.historic_signatures = false
                } else {
                    this.active_signatures = false
                    this.historic_signatures = true
                }

            },
            cancelSign(sign) {
                swal({
                    title: 'Você tem certeza?',
                    text: "Ao fazer isso sua assinatura será cancelada imediatamente e perderá o controle sobre a página da sua loja!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, quero cancelar!'
                }).then((result) => {
                    if (result.value) {
                        Pace.start()
                        this.isLoading = true

                        sendAPIDELETE(`${process.env.MIX_API_PAYMENT}/api/v1/signatures/${sign.signature_id}`).then(
                            (response) => {
                                let timerInterval

                                swal({
                                    title: 'Assinatura Cancelada!',
                                    html: 'Tudo certo, sentiremos sua falta e esperamos sua volta em breve.',
                                    timer: 2000,
                                    onClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    window.location.reload()
                                })
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
            }
        },
        mounted() {
            toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/orders`).then(
                data => {
                    if (!_.isEmpty(data.data)) {
                        let collection = collect(data.data)

                        this.actives = collection.whereIn('attributes.status', ['waiting', 'active', 'suspended', 'needs update payment method']).all()
                        this.historical = collection.whereIn('attributes.status', ['canceled', 'unknown']).all()
                    }
                }
            ).finally(() => this.isLoading = false)
        }
    }
</script>
