<template>
    <div>
        <loading-component :is-loading="isLoading"></loading-component>

        <div class="js-scrollbar u-sidebar__body">
            <header class="d-flex align-items-center u-sidebar--account__holder mt-3">
                <div class="position-relative">
                    <img class="u-sidebar--account__holder-img" :src="user.avatar" :alt="`Foto de ${user.name}`">
                    <span class="u-badge u-badge--xs u-badge-border-success u-badge-pos rounded-circle"></span>
                </div>

                <div class="ml-3">
                    <strong>{{ user.name }}</strong>
                </div>
            </header>

            <div class="u-sidebar__content--account">
                <ul class="list-unstyled u-sidebar--account__list">
                    <li class="u-sidebar--account__list-item">
                        <a class="u-sidebar--account__list-link" href="/usuario/perfil">
                            <span class="far fa-user-circle u-sidebar--account__list-icon text-primary mr-2"></span>
                            Meu perfil
                        </a>
                    </li>

                    <li class="u-sidebar--account__list-item">
                        <a class="u-sidebar--account__list-link" href="#">
                            <span class="fas fa-ticket-alt u-sidebar--account__list-icon text-warning mr-2"></span>
                            Meus ingressos
                        </a>
                    </li>

                    <li class="u-sidebar--account__list-item">
                        <a class="u-sidebar--account__list-link" href="javascript:;" @click="link()">
                            <span class="fas fa-rocket u-sidebar--account__list-icon text-success mr-2"></span>
                            Meus eventos
                        </a>
                    </li>

                    <li class="u-sidebar--account__list-item">
                        <a class="u-sidebar--account__list-link" href="javascript:;" @click="logoutSubmit">
                            <span class="fas fa-sign-out-alt u-sidebar--account__list-icon text-danger mr-2"></span>
                            Sair
                        </a>
                    </li>
                </ul>

                <div class="u-sidebar--account__list-divider"></div>

                <ul class="list-unstyled u-sidebar--account__list">
                    <li class="u-sidebar--account__list-item">
                        <a class="u-sidebar--account__list-link" href="/usuario/editar-perfil">
                            <span class="far fa-address-book u-sidebar--account__list-icon text-primary mr-2"></span>
                            Atualizar meu perfil
                        </a>
                    </li>

                    <li class="u-sidebar--account__list-item">
                        <a class="u-sidebar--account__list-link" href="/usuario/endereco">
                            <span class="fas fa-map-marked-alt u-sidebar--account__list-icon text-primary mr-2"></span>
                            Meus endereços
                        </a>
                    </li>

                    <li class="u-sidebar--account__list-item">
                        <a class="u-sidebar--account__list-link" href="/usuario/trocar-senha">
                            <span class="fas fa-key u-sidebar--account__list-icon text-primary mr-2"></span>
                            Trocar minha senha
                        </a>
                    </li>
                </ul>

                <img :src="`${urlAdmin}/logout`" style="display:none !important;" v-if="logout">

                <div class="u-sidebar--account__list-divider"></div>

                <ul class="list-unstyled u-sidebar--account__list">

                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import {sendCommon} from "../../../vendor/common";

    import LoadingComponent from '../../../components/loadingComponent'

    import {getCookie} from "../../../bootstrap"

    export default {
        name: "Dashboard",
        components: {
            LoadingComponent
        },
        props: {
            user: {
                type: Object
            }
        },
        data: () => ({
            logout: false,
            isLoading: false,
            urlAdmin: process.env.MIX_ADMIN_URL
        }),
        methods: {
            async logoutSubmit() {
                Pace.start()
                this.isLoading = true

                this.logout = true

                await sendCommon(route('logout'), {}, 'POST').then(
                    response => setTimeout(() => window.location.reload(), 1000)
                ).catch(
                    error => {
                        Pace.stop()
                        this.isLoading = false
                        console.dir(error)
                    }
                )
            },
            link(route = '/evento/meus-eventos/') {
                window.location.href = `${this.urlAdmin}${route}?token=` + getCookie('auth_token')
            }
        }
    }
</script>
