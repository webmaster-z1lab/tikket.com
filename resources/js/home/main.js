import Vue from 'vue'

// /* Validate */
import VeeValidate from 'vee-validate'

Vue.use(VeeValidate)

import LocalStorage from '../vendor/storage'

new Vue({
    name: 'Home',
    el: '#vue-home',
    data: () => ({
        keyword: ''
    }),
    methods: {
        search() {
            this.$validator.validateAll().then(
                res => {
                    if (res) {
                        new LocalStorage('search__').setItem('params', {keyword: this.keyword})

                        window.location.href = route('events')
                    }
                }
            )
        },
        searchCategory(category) {
            new LocalStorage('search__').setItem('params', {category: category})

            window.location.href = route('events')
        }
    }
});
