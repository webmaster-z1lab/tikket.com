<template>
    <div class="bg-light">
        <div class="container space-2">
            <div class="row">
                <div class="col-lg-3 mb-7 mb-lg-0">
                    <div class="card p-1 mb-4">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img class="u-lg-avatar rounded-circle" :src="user.avatar" :alt="`Avatar ${user.name}`">
                            </div>

                            <div class="mb-3">
                                <h1 class="h6 font-weight-medium mb-0">{{user.name}}</h1>
                                <small class="d-block text-muted">{{user.email}}</small>
                            </div>

                            <div class="mb-2">
                                <router-link :to="{name: 'edit_profile'}" class="btn btn-sm btn-soft-primary transition-3d-hover">
                                    <span class="far fa-envelope mr-2"></span>
                                    Editar Perfil
                                </router-link>
                            </div>
                        </div>
                    </div>

                    <div class="card p-1 mb-4">
                        <div class="card-body">
                            <h4 class="h6 mb-0">Mensagens</h4>

                            <hr>

                            <p>Nenhuma mensagem recebida</p>
                        </div>
                    </div>

                    <div class="card p-1 mb-4">
                        <div class="card-body">
                            <h4 class="h6 mb-0">Empresas</h4>

                            <hr>

                            <p>Nenhuma empresa cadastrada</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="mb-4">
                        <h2 class="h4">Bem vindo(a), {{user.name}} <!--<span class="badge badge-success ml-1">Pro</span>--></h2>
                        <h4 class="h6 text-secondary mb-0">Dados atualizados em <small>{{user.updated_at}}</small></h4>
                    </div>

                    <hr class="my-7">

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <!-- List -->
                            <ul class="list-unstyled mb-0">
                                <li class="mb-4">
                                    <div class="media">
                                        <span class="fas fa-envelope min-width-6 text-center text-secondary mr-2"></span>
                                        <div class="media-body text-lh-sm">
                                            <span class="d-block font-size-14">Email:</span>
                                            <span class="small">{{user.email}}</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-4">
                                    <div class="media">
                                        <span class="fas fa-map-marker-alt min-width-6 text-center text-secondary mr-2"></span>
                                        <div class="media-body text-lh-sm">
                                            <span class="d-block font-size-14">Location:</span>
                                            <span class="small mr-1">Brasil</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-4">
                                    <div class="media">
                                        <span class="fas fa-birthday-cake min-width-6 text-center text-secondary mr-2"></span>
                                        <div class="media-body">
                                            <span class="d-block font-size-14">Data de nascimento:</span>
                                            <small class="d-block text-muted">{{user.birth_date}}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-4" v-if="user.phone !== null">
                                    <div class="media">
                                        <span class="fas fa-mobile-alt min-width-6 text-center text-secondary mr-2"></span>
                                        <div class="media-body text-lh-sm">
                                            <span class="d-block font-size-14">Telefone:</span>
                                            <span class="small mr-1">{{user.phone.formatted}}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="my-7">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        name: "MyProfile",
        data: () => ({

        }),
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes,
            })
        },
        methods: {

        }
    }
</script>
