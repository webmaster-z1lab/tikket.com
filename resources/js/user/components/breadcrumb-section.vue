<template>
    <div class="bg-primary" v-if="!notFoundPage">
        <div class="container space-top-1 pb-3">
            <div class="row">
                <div class="col-lg-5 order-lg-2 text-lg-right mb-4 mb-lg-0">
                    <div class="d-flex d-lg-inline-block justify-content-between justify-content-lg-end align-items-center align-items-lg-start">
                        <ol class="breadcrumb breadcrumb-white breadcrumb-no-gutter mb-0">
                            <li class="breadcrumb-item" v-for="route in routeBreadcrumb" :class="route.route.name !== route_current ? 'active' : ''">
                                <router-link class="breadcrumb-link" :to="route.route" v-if="route.route.name !== route_current">{{route.name}}</router-link>
                                <span  class="breadcrumb-item active" aria-current="page" v-else>{{route.name}}</span>
                            </li>
                        </ol>

                        <div class="d-lg-none">
                            <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--white"
                                    aria-label="Toggle navigation"
                                    aria-expanded="false"
                                    aria-controls="breadcrumbNavBar"
                                    data-toggle="collapse"
                                    data-target="#breadcrumbNavBar">
                                <span id="breadcrumbHamburgerTrigger" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-lg-1">
                    <div class="row">
                        <div class="col-3 col-md-2">
                            <div class="media d-block d-sm-flex align-items-sm-center">
                                <div class="u-lg-avatar position-relative mb-3 mb-sm-0 mr-3">
                                    <img class="img-fluid rounded-circle" :src="user.avatar" :alt="`Avatar ${user.name}`">

                                    <span class="badge badge-md badge-outline-success badge-pos badge-pos--bottom-right rounded-circle" v-if="user.email_verified">
                                    <span class="fas fa-check"></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-9 col-md-10">
                            <div class="media-body">
                                <h1 class="h3 text-white font-weight-medium mb-1">{{ user.name }}</h1>
                                <span class="d-block text-white">{{ user.email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container space-bottom-1 space-bottom-lg-0">
            <div class="d-lg-flex justify-content-lg-between align-items-lg-center">

                <div class="u-header u-header-left-aligned-nav u-header--bg-transparent-lg u-header--white-nav-links z-index-4">
                    <div class="u-header__section bg-transparent">
                        <nav class="js-breadcrumb-menu navbar navbar-expand-lg u-header__navbar u-header__navbar--no-space">
                            <div id="breadcrumbNavBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">
                                    <li class="nav-item u-header__nav-item">
                                        <router-link :to="{name: 'my_profile'}" class="nav-link u-header__nav-link">
                                            Meu Perfil
                                        </router-link>
                                    </li>

                                    <li class="nav-item hs-has-sub-menu u-header__nav-item"
                                        data-event="hover"
                                        data-animation-in="slideInUp"
                                        data-animation-out="fadeOut">
                                        <a id="generalDropdown" class="nav-link u-header__nav-link u-header__nav-link-toggle" href="javascript:;" aria-haspopup="true" aria-expanded="false" aria-labelledby="generalDropdownMenu">
                                            Configurações da Conta
                                        </a>

                                        <ul id="generalDropdownMenu" class="hs-sub-menu u-header__sub-menu u-header__sub-menu--spacer" style="min-width: 230px;" aria-labelledby="generalDropdown">
                                            <li>
                                                <router-link :to="{name: 'edit_profile'}"
                                                             class="nav-link u-header__sub-menu-nav-link">
                                                    Editar Perfil
                                                </router-link>
                                            </li>
                                            <li>
                                                <router-link :to="{name: 'address'}"
                                                             class="nav-link u-header__sub-menu-nav-link">
                                                    Endereço
                                                </router-link>
                                            </li>
                                            <li>
                                                <router-link :to="{name: 'change_password'}"
                                                             class="nav-link u-header__sub-menu-nav-link">
                                                    Mudar Senha
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item u-header__nav-item">
                                        <router-link :to="{name: 'my_companies'}" class="nav-link u-header__nav-link">
                                            Minhas Empresas
                                        </router-link>
                                    </li>
                                    <li class="nav-item u-header__nav-item">
                                        <router-link :to="{name: 'my_subscriptions'}" class="nav-link u-header__nav-link">
                                            Minhas Assinaturas
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .img-fluid, .img-thumbnail {
        max-width: 80px;
        max-height: 80px;
    }
</style>

<script>
    import {mapState} from 'vuex'

    export default {
        name: "BreadcrumbSection",
        data: () => ({
            route_current: '',
            notFoundPage: false
        }),
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes
            }),
            routeBreadcrumb() {
                const routes = {
                    'my_profile': [
                        {
                            route: {name: 'home'},
                            name: 'Home',
                        },
                        {
                            route: {name: 'my_profile'},
                            name: 'Meu Perfil',
                        }
                    ], 'edit_profile': [
                        {
                            route: {name: 'home'},
                            name: 'Home',
                        },
                        {
                            route: {name: 'edit_profile'},
                            name: 'Editar Perfil',
                        }
                    ], 'change_password': [
                        {
                            route: {name: 'home'},
                            name: 'Home',
                        },
                        {
                            route: {name: 'change_password'},
                            name: 'Mudar Senha',
                        }
                    ], 'my_companies': [
                        {
                            route: {name: 'home'},
                            name: 'Home',
                        },
                        {
                            route: {name: 'my_companies'},
                            name: 'Minhas Empresas',
                        }
                    ], 'add_address': [
                        {
                            route: {name: 'home'},
                            name: 'Home',
                        },
                        {
                            route: {name: 'add_address'},
                            name: 'Adicionar Endereço',
                        }
                    ], 'my_subscriptions': [
                        {
                            route: {name: 'home'},
                            name: 'Home',
                        },
                        {
                            route: {name: 'my_subscriptions'},
                            name: 'Minhas Assinaturas',
                        }
                    ]
                }

                if (this.$route.name === 'page_not_found') this.notFoundPage = true

                this.route_current = this.$route.name

                return routes[this.$route.name]
            }
        }
    }
</script>
