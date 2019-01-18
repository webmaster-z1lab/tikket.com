import {HTTP} from "./bootstrap"

function submit() {
    let form = document.getElementById('login-form')
    let data = new FormData(form)

    HTTP({
        method: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data
    }).then(
        response => {
            console.log(response)
            window.location.replace(`${data.get('continue')}&token=${response.data.access_token}`)
        }
    ).catch(
        error => console.dir(error)
    )
}

function init() {
    document.getElementById('login-button').addEventListener('click', submit)
    //document.getElementById('register-button').addEventListener('click', submit)
}

window.onload = init
