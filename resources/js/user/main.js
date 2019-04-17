import Vue from 'vue'
import VueRouter from 'vue-router'

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

const router = new VueRouter({
    mode: 'history',
    base: '/usuario',
    suppressTransitionError: true,
    routes
});

/* Filter */
Vue.filter('aws_url', function (value) {
    if (!value) return ''

    return `${process.env.MIX_AWS_CDN_ENDPOINT}/${value}`
})


new Vue({
    el: '#vue-user',
    name: 'VueUser',
    render: h => h(VueMain),
    store,
    router
});
