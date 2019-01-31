import Vue from 'vue'

// /* Validate */
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

require('../forms/config/validator')

/* Components */
import Sidebar from './main.vue'

new Vue({
    name: 'Main',
    el: '#vue-sidebar',
    render: h => h(Sidebar)
});
