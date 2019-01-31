import Vue from 'vue'
import {sendAuth, askForToken} from "../vendor/common"
import AlertVue from '../components/alertComponent'

/* Validate */
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

require('../forms/config/validator')

import LoadingComponent from '../components/loadingComponent'

new Vue({
    name: 'Login',
    el: '#vue-login',
    components: {
        AlertVue,
        LoadingComponent
    },
    data: () => ({
        isLoading: false,
        email: '',
        password: '',
        alert: {
            active: false,
            msg: {},
            type: ''
        }
    }),
    methods: {
        loginSubmit() {
            this.$validator.validateAll().then(
                res => {
                    if (res) {
                        Pace.start()
                        this.isLoading = true
                        this.error = null

                        sendAuth(process.env.MIX_AUTH_SERVER_API + '/login', {
                            email: this.email,
                            password: this.password
                        }, 'POST').then(
                            response => {
                                window.location.replace(`${askForToken()}&token=${response.access_token}`)
                            }
                        ).catch(
                            error => {
                                Pace.stop()
                                this.isLoading = false

                                if (_.isObject(error.response.data)) {
                                    this.alert.active = true
                                    this.alert.msg = error.response.data.errors
                                    this.alert.type = 'danger'
                                } else {
                                    console.dir(error)
                                }
                            }
                        )
                    }
                }
            )
        }
    }
});
