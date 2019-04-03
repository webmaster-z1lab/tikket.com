import Vue from 'vue'
import VueRouter from 'vue-router'
import VueCurrencyFilter from 'vue-currency-filter'

import LocalStorage from "../vendor/storage"
import moment from 'moment'

import {sendAPIPOST} from "../vendor/common";

/* Configs */
import VueMain from './main.vue'
import store from './store/store'
import routes from './router'

/* validate */
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate, { inject: false })

require('../forms/config/validator')

/* Route */
Vue.use(VueRouter)

/* Money */
Vue.use(VueCurrencyFilter,
    {
        symbol : 'R$',
        thousandsSeparator: '.',
        fractionCount: 2,
        fractionSeparator: ',',
        symbolPosition: 'front',
        symbolSpacing: true
    })

/* Route */
const router = new VueRouter({
    mode: 'history',
    base: '/cart',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.conclusionCart)) {
        let cartLS = new LocalStorage('cart__').getItem('user'),
            orderLS = new LocalStorage('order__').getItem('user')

        if (!_.isEmpty(orderLS)) {
            next()
        } else {
            sendAPIPOST(`${process.env.MIX_API_VERSION_ENDPOINT}/orders`, {cart: cartLS.id, _method: 'POST', sent_at: moment().format('YYYY-MM-DD HH:mm:ss')})
                .then(
                    response => {
                        new LocalStorage('order__').setItem('user', response.data.data)

                        next()
                    })
                .catch(
                    (error) => {
                        let title = error.response.data.errors ? error.response.data.errors.title : '',
                            message = error.response.data.errors ? error.response.data.errors.detail : error.response.data.message

                        next({name: "error", params: {code: error.response.status, title: title, message: message}})
                    }
                )
        }
    } else {
        next()
    }
})

new Vue({
    el: '#vue-cart',
    name: 'VueCart',
    render: h => h(VueMain),
    store,
    router
});
