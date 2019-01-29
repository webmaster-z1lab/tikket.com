<template>
    <div class="container space-2">
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="u-bg-light-blue-50">
            <div class="container u-space-2" v-if="!checkEmpty(places)">
                <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-sm-4 col-md-6 mb-3 mb-sm-0">
                        <h2 class="h4 mb-0">Suas empresas</h2>
                    </div>
                </div>

                <div class="pb-7">
                    <div v-for="n in forList">
                        <div class="card-deck d-block d-md-flex">
                            <a :href="routeStore(place.id)" class="card transition-3d-hover mb-5" v-for="place in forPage(places, n)">
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <span class="small text-secondary">
                                            <span class="fas fa-bookmark text-primary mr-1"></span>
                                            {{ place.attributes.types.join('|') }}
                                        </span>
                                    </div>

                                    <div class="text-center">
                                        <h3 class="h5 mb-1">{{ place.attributes.name }}</h3>

                                        <p class="font-size-14" v-if="!checkEmpty(place.relationships.phones)">
                                            <div v-for="phone in place.relationships.phones">
                                                <i class="fab fa-whatsapp text-success" v-if="phone.attributes.is_whatsapp"></i>
                                                {{ phone.attributes.formatted }}
                                            </div>
                                        </p>

                                        <p>{{ place.relationships.address.attributes.formatted }}</p>
                                    </div>
                                </div>

                                <div class="card-footer text-center">
                                    <div class="row align-items-center mb-4">
                                        <div class="col">
                                            <h5 class="small font-weight-normal text-secondary mb-0">Aberto Agora</h5>

                                            <span :class="place.attributes.is_open_now ? 'text-success' : 'text-danger'" v-if="!checkNull(place.attributes.is_open_now)">
                                                {{ place.attributes.is_open_now ? 'SIM' : 'NÃO' }}
                                            </span>

                                            <span class="text-secondary" v-else>NÃO INFORMADO</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container u-space-2" v-else>
                <div class="text-center p-9">
                    <figure class="w-65 mx-auto pb-4">
                        <img class="w-50" src="https://cdn.z1lab.com.br/images/undraw/undraw_analysis_4jis.svg" alt="SVG">
                    </figure>

                    <div class="pb-4">
                        <h1 class="h3"><strong>Ops, não encontramos nada.</strong></h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import LoadingComponent from '../../components/loadingComponent'
    import {toSeek} from "../../vendor/common"
    import {mapState} from 'vuex'

    export default {
        name: "MyCompanies",
        components: {
            LoadingComponent
        },
        data: () => ({
            isLoading: true,
            places: [],
        }),
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes,
            }),
            forList() {
                return Math.ceil(this.places.length / 3)
            }
        },
        created () {
            toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/places`).then(
                response => {
                    this.places = response.data
                })
                .finally(() => {
                    this.isLoading = false
                })
        },
        methods: {
            checkEmpty(item){
                return _.isEmpty(item)
            },
            checkNull(item){
                return _.isNull(item)
            },
            forPage(places, n) {
                let collection =  collect(places)

                return collection.forPage(n, 3).all()
            },
            routeStore(id) {
                return route('store', id)
            }
        }
    }
</script>
