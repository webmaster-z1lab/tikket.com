import Vue from 'vue'
import {sendAuth, askForToken} from "../vendor/common";
import AlertVue from '../components/alertComponent'

// /* Validate */
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

require('../forms/config/validator')

import LoadingComponent from '../components/loadingComponent'

new Vue({
    name: 'Register',
    el: '#vue-register',
    components: {
        LoadingComponent,
        AlertVue
    },
    data: () => ({
        isLoading: false,
        name: '',
        email: '',
        password: '',
        password_confirm: '',
        alert: {
            active: false,
            msg: {},
            type: ''
        }
    }),
    methods: {
        registerSubmit() {
            this.$validator.validateAll().then(
                res => {
                    if (res) {
                        this.isLoading = true
                        this.error = null

                        sendAuth(
                            process.env.MIX_AUTH_SERVER_API + '/register',
                            {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirm},
                            'POST'
                        ).then(
                            response => {
                                window.location.replace(`${askForToken()}&token=${response.access_token}`)
                            }
                        ).catch(
                            error => {
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
