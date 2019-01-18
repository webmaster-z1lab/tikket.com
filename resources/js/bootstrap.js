import swal from 'sweetalert2'

window._ = require('lodash');
window.collect = require('collect.js');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.toast = swal.mixin({
    toast: true,
    position: 'bottom',
    showConfirmButton: false,
    timer: 3000
});

if (_.isEmpty(getCookie('id_token'))) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${getCookie('client_token')}`
} else {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${getCookie('auth_token')}`
    window.axios.defaults.headers.common['ID-TOKEN'] = getCookie('id_token')
}

export const HTTP = axios.create();

export function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
