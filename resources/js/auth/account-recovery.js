import Vue from 'vue'
import {sendAuth} from "../vendor/common"
import AlertVue from '../components/alertComponent'

// /* Validate */
import VeeValidate from 'vee-validate'

Vue.use(VeeValidate)

require('../forms/config/validator')

import LoadingComponent from '../components/loadingComponent'

new Vue({
    name: 'AccountRecovery',
    el: '#vue-account-recovery',
    components: {
        LoadingComponent,
        AlertVue
    },
    data: () => ({
        isLoading: false,
        email: '',
        alert: {
            active: false,
            msg: {},
            type: ''
        }
    }),
    methods: {
        resetSubmit() {
            this.$validator.validateAll().then(
                res => {
                    if (res) {
                        this.isLoading = true
                        this.error = null

                        sendAuth(process.env.MIX_AUTH_SERVER_API + '/recovery', {email: this.email}, 'POST').then(
                            response => {
                                this.alert.active = true
                                this.alert.msg.detail = 'Tudo certo! Agora é só você checar o seu email para continuarmos o processo.'
                                this.alert.type = 'success'
                            }
                        ).catch(
                            error => {
                                if (_.isObject(error.response.data)) {
                                    this.alert.active = true
                                    this.alert.msg = error.response.data.errors
                                    this.alert.type = 'danger'
                                } else {
                                    console.dir(error)
                                }
                            }
                        ).finally(
                            () => {
                                this.isLoading = false
                            }
                        )
                    }
                }
            )
        }
    }
});
