import Vue from 'vue'

// /* Validate */
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

require('../forms/config/validator')

/* Components */
import Sidebar from './main.vue'

/* Filter */
Vue.filter('aws_url', function (value) {
    if (!value) return ''

    return `${process.env.MIX_AWS_CDN_ENDPOINT}/${value}`
})

new Vue({
    name: 'Main',
    el: '#vue-sidebar',
    render: h => h(Sidebar)
});
