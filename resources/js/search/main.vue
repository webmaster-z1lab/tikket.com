<template>
    <div class="bg-light">
        <loading-component :isLoading="isLoading"></loading-component>

        <div class="container space-lg-3 space-2">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body p-7">
                            <form method="post" class="js-validate">
                                <div class="row align-items-md-center">
                                    <div class="col-lg-4 mb-4 mb-lg-0" :class="errors.has('keyword') ? 'u-has-error' : ''">
                                        <div class="js-focus-state input-group">
                                            <input type="text" class="form-control u-form__input" id="keyword" placeholder="Nome, categoria, ..."
                                                   aria-label="Nome, categoria, ..." aria-describedby="Nome, categoria, ..."
                                                   v-model="keyword" v-validate="'required'" name="keyword">
                                            <div class="input-group-append u-form__append">
                                                <span class="input-group-text u-form__text">
                                                    <span class="fa fa-search u-form__text-inner"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0" :class="errors.has('typeahead') ? 'u-has-error' : ''">
                                        <typeahead placeholder="Viçosa, MG" validate="required" @value="setTypeahead" :value="typeahead_initial"></typeahead>
                                    </div>

                                    <div class="col-sm-6 col-lg-2 mb-4 mb-lg-0">
                                        <select class="custom-select" name="period" v-model="period">
                                            <option :value="item.value" v-for="item in periods">{{item.name}}</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 text-lg-right">
                                        <button type="button" class="btn btn-block btn-primary transition-3d-hover" @click="search">Buscar</button>
                                    </div>
                                </div>
                            </form>
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
                                        <div class="card mb-3">
                                            <img class="card-img-top" :src="event.relationships.image.attributes.cover" alt="Card image cap">

                                            <div class="card-body" style="position: absolute">
                                                <div class="d-flex align-items-center mb-5">
                                                    <div class="position-relative">
                                                        <a :id="`rating1DropdownInvoker-${key}`" class="btn btn-xs btn-soft-warning btn-pill"
                                                           @blur="closeDropdown(`#rating1Dropdown-${key}`)"
                                                           @focus="openDropdown(`#rating1DropdownInvoker-${key}`)"
                                                           href="javascript:;" role="button"
                                                           :aria-controls="`rating1Dropdown-${key}`"
                                                           aria-haspopup="true"
                                                           aria-expanded="false">
                                                            <i class="fas fa-ticket-alt"></i>
                                                        </a>

                                                        <div :id="`rating1Dropdown-${key}`" class="dropdown-menu dropdown-unfold p-3"
                                                             :aria-labelledby="`rating1DropdownInvoker-${key}`" style="width: 190px;">
                                                            <p class="text-dark mb-0">Status</p>
                                                            <p class="mb-0" :class="statusFormat(event.attributes.status).color">
                                                                {{statusFormat(event.attributes.status).name}}
                                                            </p>
                                                            <p class="text-dark mb-0">Fim do Lote</p>
                                                            <p class="mb-0">{{formatCarbon(event.relationships.entrances[0].attributes.lot.finishes_at)}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer text-center py-0">
                                                <div class="text-center">
                                                    <div class="my-2">
                                                        <a :href="urlFormat('event.attributes.url')" class="mb-0 h6">{{event.attributes.name}}</a>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Load More Button -->
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
                        <!-- End Load More Button -->
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
    import Typeahead from '../components/typeaheadComponent'
    import LocalStorage from "../vendor/storage"
    import moment from 'moment'

    moment.locale('pt_br')

    import {toSeek} from "../vendor/common"
    import {getGeoIP} from "../vendor/api";

    export default {
        name: "Search",
        $_veeValidate: {
            validator: 'new'
        },
        components: {
            LoadingComponent,
            Typeahead
        },
        data: () => ({
            isLoading: true,
            typeahead_initial: '',
            typeahead: '',
            keyword: '',
            period: '',
            events: [],
            next: null
        }),
        filters: {
            upperCase(value) {
                if (!value) return ''
                value = value.toString()

                return value.toUpperCase()
            }
        },
        computed:{
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
            setTypeahead(value) {
                this.typeahead = value
            },
            search() {
                this.$validator.validateAll().then(
                    res => {
                        if (res) {
                            this.setLoading(true)
                            new LocalStorage('search__').setItem('params', {keyword: this.keyword, city: this.typeahead, period: this.period})

                            toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/events/search`, {
                                keyword: this.keyword,
                                city: this.typeahead,
                                period: this.period
                            }).then(
                                response => {
                                    this.events = response.data
                                    this.next = response.links.next
                                }
                            ).finally(() => this.setLoading(false))
                        }
                    }
                )
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
            openDropdown(id) {
                $(id).dropdown('toggle')
            },
            closeDropdown(id) {
                $(id).removeClass('show')
            }
        },
        async mounted() {
            let searchQuery = new LocalStorage('search__').getItem('params')

            if (!_.isEmpty(searchQuery)) {
                this.keyword = searchQuery.keyword || searchQuery.category || ''
                this.period = searchQuery.period || ''

                if (searchQuery.city)  {
                    this.typeahead_initial = searchQuery.city
                } else {
                    await getGeoIP().then(response => {
                        this.typeahead_initial = `${response.data.city} - ${response.data.region}`
                    })
                }

                toSeek(`${process.env.MIX_API_VERSION_ENDPOINT}/events/search`, {
                    category: searchQuery.category,
                    keyword: searchQuery.keyword,
                    city: this.typeahead,
                    period: this.period
                }).then(
                    response => {
                        this.events = response.data
                        this.next = response.links.next
                    }
                ).finally(() => this.setLoading(false))
            } else {
                await getGeoIP().then(response => {
                    this.typeahead_initial = `${response.data.city} - ${response.data.region}`
                })

                this.setLoading(false)
            }
        }
    }
</script>
