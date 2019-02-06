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
                                    <span class="fas fa-pencil-square mr-2"></span>
                                    Editar Perfil
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="mb-4">
                        <h2 class="h4">{{ greetings() }}, {{user.short_name}}.</h2>
                        <h4 class="h6 text-secondary mb-0">Você atualizou seus dados em {{ user.updated_at }}.</h4>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-12">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-4">
                                    <div class="media">
                                        <span class="fas fa-envelope min-width-6 text-center text-secondary mr-2"></span>
                                        <div class="media-body text-lh-sm">
                                            <span class="d-block font-size-14">Email:</span>
                                            <span class="d-block text-muted">{{user.email}}</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="mb-4">
                                    <div class="media">
                                        <span class="fas fa-birthday-cake min-width-6 text-center text-secondary mr-2"></span>
                                        <div class="media-body">
                                            <span class="d-block font-size-14">Data de nascimento:</span>

                                            <router-link class="link-muted" :to="{name: 'edit_profile'}" v-if="user.birth_date === null">
                                                Definir
                                            </router-link>

                                            <span class="d-block text-muted" v-else>{{ user.birth_date }}</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="mb-4">
                                    <div class="media">
                                        <span class="fas fa-mobile-alt min-width-6 text-center text-secondary mr-2"></span>
                                        <div class="media-body">
                                            <span class="d-block font-size-14">Telefone:</span>

                                            <router-link class="link-muted" :to="{name: 'edit_profile'}" v-if="user.phone === null">
                                                Definir
                                            </router-link>

                                            <span class="d-block text-muted" v-else>{{ user.phone.formatted }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="my-4">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        name: "MyProfile",
        data: () => ({}),
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes,
            })
        },
        methods: {
            greetings() {
                let today = new Date()
                let curHr = today.getHours()

                if (curHr < 12) {
                    return 'Bom dia'
                } else if (curHr < 18) {
                    return 'Boa tarde'
                } else {
                    return 'Boa noite'
                }
            }
        }
    }
</script>
