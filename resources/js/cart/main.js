import Vue from 'vue'
import VueRouter from 'vue-router'
import VueCurrencyFilter from 'vue-currency-filter'

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
    //suppressTransitionError: true,
    routes
});

new Vue({
    el: '#vue-cart',
    name: 'VueCart',
    render: h => h(VueMain),
    store,
    router
});
