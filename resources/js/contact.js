import {HTTP} from './bootstrap'
import swal from 'sweetalert2'

const contact_form = document.getElementById('contact')

function init() {
    contact_form.addEventListener('submit', function (ev) {
        ev.preventDefault()
        let data = new FormData(ev.target)
        HTTP({
            method: 'POST',
            url: `${process.env.MIX_API_VERSION_ENDPOINT}/actions/contact`,
            data: data
        }).then(response => {
            swal({
                text: response.data.message,
                type: 'success'
            })
        }).catch(error => {
            if (error.response.status === 422) {
                let message = ''
                for (let key in error.response.data.errors.meta) {
                    for (let i in error.response.data.errors.meta[key]) {
                        if (message === '') {message += '<br>'}
                        message += error.response.data.errors.meta[key][i]
                    }
                }
                swal({
                    text: message,
                    type: 'error'
                })
            } else {
                swal({
                    text: error.response.data.errors.detail,
                    type: 'error'
                })
            }
        })
    })
}

window.onload = init()