<template>
    <div class="bg-light">
        <loading-component :isLoading="isLoading"></loading-component>

        <div class="container space-lg-3 space-2">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body p-7">
                            <div>
                                <div class="row align-items-md-center">
                                    <div class="col-md-7 mb-4 mb-lg-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="keyword" placeholder="Nome do evento, cidade, estado ..."
                                                   aria-label="Nome do evento, cidade, estado..." aria-describedby="Nome do evento, cidade, estado..."
                                                   v-model="search_params.keyword" name="keyword" @keydown.enter="search">

                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <span class="fa fa-search"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5 col-lg-3 mb-4 mb-lg-0">
                                        <label for="period" class="sr-only">Período</label>

                                        <select class="custom-select" name="period" id="period" v-model="search_params.period">
                                            <option :value="item.value" v-for="item in periods">{{item.name}}</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 text-lg-right">
                                        <button type="button" class="btn btn-block btn-primary transition-3d-hover" @click="search">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="container u-space-2" v-if="!checkEmpty(events)">
                        <div class="row justify-content-between align-items-center mb-4">
                            <div class="col-sm-4 col-md-6 mb-3 mb-sm-0">
                                <h2 class="h6 mb-0">Eventos encontrados</h2>
                            </div>
                        </div>

                        <div class="mb-7">
                            <div class="card-deck card-sm-gutters-1 d-block d-sm-flex">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4" v-for="(event, key) in events">
                                        <a :href="urlFormat(event.attributes.url)" class="card mb-3">
                                            <img class="card-img-top" :src="event.relationships.image.attributes.cover" alt="Card image cap">

                                            <div class="card-footer text-center py-0">
                                                <div class="text-center">
                                                    <div class="my-2">
                                                        <h4 class="mb-0 h6">{{event.attributes.name}}</h4>
                                                    </div>
                                                </div>
                                                <hr class="mt-0 mb-2">
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-3 u-ver-divider">
                                                        <h5 class="text-primary mb-0">{{day(event.attributes.starts_at)}}</h5>
                                                        <span class="align-middle">{{month(event.attributes.starts_at) | upperCase}}</span>
                                                    </div>
                                                    <div class="col-9 text-left">
                                                        <h5 class="small mb-0">Parthenon</h5>
                                                        <small class="far fa-clock text-secondary align-middle mr-1"></small>
                                                        <span class="small align-middle mr-1" style="font-size: 75%">{{hours(event.attributes.starts_at)}}</span>
                                                        <small class="fas fa-map-marker-alt text-secondary align-middle mr-1"></small>
                                                        <span class="small align-middle" style="font-size: 75%">{{event.attributes.address.city}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="cubeLoadMore" class="text-center p-3 pb-5">
                            <a href="javascript:;" class="cbp-l-loadMore-link link" rel="nofollow" v-if="!checkNull(next)" @click="searchMore">
                                <span class="text-primary">
                                  Exibir Mais resultados
                                  <span class="link__icon ml-1">
                                    <span class="link__icon-inner">&#43;</span>
                                  </span>
                                </span>
                            </a>
                            <a href="javascript:;" class="cbp-l-loadMore-link link" rel="nofollow" v-else>
                                <span class="text-secondary">Não há mais resultados</span>
                            </a>
                        </div>
                    </div>

                    <div class="container u-space-2" v-else>
                        <div class="text-center p-9">
                            <figure class="w-65 mx-auto pb-4">
                                <img class="w-50" :src="'images/undraw/undraw_analysis_4jis.svg' | aws_url" alt="SVG">
                            </figure>

                            <div class="pb-4">
                                <h1 class="h3"><strong>Ops, não encontramos nada.</strong></h1>

                                <p>
                                    Com os dados fornecidos não conseguimos encontrar nada!
                                    Tente pesquisar novamente passando informações diferentes nos campos de busca.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LoadingComponent from '../components/loadingComponent'
    import moment from 'moment'
    import {toSeek} from "../vendor/common"

    moment.locale('pt_br')

    export default {
        name: "Search",
        components: {
            LoadingComponent
        },
        data: () => ({
            isLoading: true,
            typeahead_initial: '',
            search_params: {
                keyword: '',
                period: '',
            },
            events: [],
            next: null,
        }),
        filters: {
            upperCase(value) {
                if (!value) return ''
                value = value.toString()

                return value.toUpperCase()
            }
        },
        computed: {
            forList() {
                return Math.ceil(this.places.length / 3)
            },
            periods() {
                return [
                    {
                        name: 'Todos',
                        value: ''
                    },
                    {
                        name: 'Hoje',
                        value: 'today'
                    },
                    {
                        name: 'Amanhã',
                        value: 'tomorrow'
                    },
                    {
                        name: 'Essa Semana',
                        value: 'this_week'
                    },
                    {
                        name: 'Esse Final de Semana',
                        value: 'this_weekend'
                    },
                    {
                        name: 'Próxima Semana',
                        value: 'next_week'
                    },
                    {
                        name: 'Esse Mês',
                        value: 'this_month'
                    },
                    {
                        name: 'Próximo Mês',
                        value: 'next_month'
                    }
                ]
            }
        },
        methods: {
            statusFormat(status) {
                let translate = {
                    finalized: {
                        name: 'Evento Finalizado',
                        color: 'text-secondary'
                    },
                    canceled: {
                        name: 'Evento Cancelado',
                        color: 'text-danger'
                    },
                    published: {
                        name: 'Evento Ativo',
                        color: 'text-success'
                    }
                }

                return translate[status]
            },
            formatCarbon(date) {
                return moment(date, "YYYY-MM-DD'T'HH:mm:ssZ").format('DD/MM/YYYY HH:mm');
            },
            day(date) {
                return moment(date, 'DD/MM/YYYY HH:mm').format('DD');
            },
            hours(date) {
                return moment(date, 'DD/MM/YYYY HH:mm').format('HH:mm');
            },
            month(date) {
                return moment(date, 'DD/MM/YYYY HH:mm').format('MMM');
            },
            urlFormat(ext) {
                return `${process.env.MIX_APP_URL}/evento/${ext}`
            },
            checkEmpty(item) {
                return _.isEmpty(item)
            },
            checkNull(item) {
                return _.isNull(item)
            },
            forPage(places, n) {
                let collection = collect(places)

                return collection.forPage(n, 3).all()
            },
            setUrlParams() {
                let url = new URL(window.location.href)
                let query_string = url.search;
                let search = new URLSearchParams(query_string);
                let title = `Eventos com a palavra-chave '${this.search_params.keyword}' | Tikket`

                search.set('period', this.search_params.period)
                search.set('keyword', this.search_params.keyword)

                window.history.replaceState({}, title, decodeURIComponent(`${location.pathname}?${search}`))
            },

            search() {
                this.setLoading(true)

                console.log(this.search_params.city)

                this.setUrlParams()

                toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/events/search`, this.search_params).then(
                    response => {
                        this.events = response.data
                        this.next = response.links.next
                    }
                ).finally(() => this.setLoading(false))
            },
            searchMore() {
                this.setLoading(true)

                toSeek(this.next).then(
                    response => {
                        this.events = _.union(this.places, response.data)
                        this.next = response.links.next
                    }
                ).finally(() => this.setLoading(false))
            },
            setLoading(value) {
                this.isLoading = value
            },
        },
        async mounted() {
            let url = new URL(window.location.href)
            let query_string = url.search
            let search = new URLSearchParams(query_string)

            this.search_params.keyword = search.get('keyword')
            this.search_params.period = search.get('period')

            toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/events/search`, this.search_params).then(
                response => {
                    this.events = response.data
                    this.next = response.links.next
                }
            ).finally(() => this.setLoading(false))
        }
    }
</script>
