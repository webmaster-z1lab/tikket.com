import Vue from 'vue'

import MainVue from './main.vue'

/* Filter */
Vue.filter('aws_url', function (value) {
    if (!value) return ''

    return `${process.env.MIX_AWS_CDN_ENDPOINT}/${value}`
})

new Vue({
    name: 'Main',
    el: '#vue-search',
    render: h => h(MainVue)
});
