<template>
    <div>
        <loading-component :is-loading="isLoading"></loading-component>

        <form-vue :data="form" @submitForm="submitForm"></form-vue>
    </div>
</template>

<script>
    import FormVue from '../../forms/forms-vue'
    import LoadingComponent from '../../components/loadingComponent'

    import {mapState, mapActions} from 'vuex'
    import {toSeek, submitFormVue, refreshData} from "../../vendor/common"

    export default {
        name: "EditProfile",
        components: {
            FormVue,
            LoadingComponent
        },
        data: () => ({
            isLoading: true,
            form: null
        }),
        computed: {
            ...mapState({
                user: state => state.dataBasic.data.attributes,
                links: state => state.dataBasic.links
            })
        },
        created() {
            this.searchUser()
        },
        methods: {
            ...mapActions(['changeDataBasic']),
            async submitForm(dataForm) {
                Pace.start()
                this.isLoading = true

                await submitFormVue(this.form.action, dataForm).then(
                    async response => {
                        await refreshData().then( response => this.changeDataBasic(response.data))

                        toast({
                            type: 'success',
                            title: 'Informações alteradas com sucesso!'
                        })
                    }
                ).catch(
                    error => {
                        if (_.isObject(error.response.data)) {
                            toast({
                                type: 'error',
                                title: error.response.data.errors.detail
                            })
                        } else {
                            console.dir(error)
                        }
                    }
                ).finally(() => {
                        Pace.stop()
                        this.isLoading = false
                    }
                )
            },
            searchUser() {
                toSeek(`${this.links.self}/form/profile`).then(
                    data => this.form = data.data.attributes
                ).finally(() => this.isLoading = false)
            }
        }
    }
</script>
