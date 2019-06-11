import swal from 'sweetalert2'
import Echo from 'laravel-echo'

window._ = require('lodash');
window.collect = require('collect.js');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';
window.axios.defaults.headers.common['Content-Type'] = 'application/json';

window.toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

if (_.isEmpty(getCookie('id_token'))) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${getCookie('client_token')}`
} else {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${getCookie('auth_token')}`
    window.axios.defaults.headers.common['ID-TOKEN'] = getCookie('id_token')

    window.io = require('socket.io-client')

    window.Echo = new Echo({
        broadcaster: 'socket.io',
        host: process.env.MIX_ECHO_HOST,
        auth: {headers: {Authorization: "Bearer " + getCookie('auth_token'), "ID-TOKEN": getCookie('id_token')}}
    });
}

export const HTTP = axios.create();

/**
 * @param cname
 * @returns {string}
 */
export function getCookie(cname) {
    let name = cname + "=",
        ca = document.cookie.split(';');

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
