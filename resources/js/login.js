import {HTTP} from "./bootstrap"

function loginSubmit() {
    let form = document.getElementById('login-form')
    let data = new FormData(form)
    console.log('click-login')
    HTTP({
        method: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data
    }).then(
        response => {
            window.location.replace(`${data.get('continue')}&token=${response.data.access_token}`)
        }
    ).catch(
        error => console.dir(error)
    )
}

function registerSubmit() {
    let form = document.getElementById('register-form')
    let data = new FormData(form)
    console.log('click-register')
    HTTP({
        method: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data
    }).then(
        response => {
            authorize(data.get('continue'), response.data.access_token)
        }
    ).catch(
        error => console.dir(error)
    )
}

function logoutSubmit() {
    let form = document.getElementById('logout-form')
    let data = new FormData(form)

    HTTP({
        method: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data
    }).then(
        response => {
            window.location.href = data.get('continue');
        }
    ).catch(
        error => console.dir(error)
    )
}

function recoverySubmit() {
    let form = document.getElementById('recovery-form')
    let data = new FormData(form)

    HTTP({
        method: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data
    }).then(
        response => console.dir(response)
    ).catch(
        error => console.dir(error)
    )
}

function resetSubmit() {
    let form = document.getElementById('reset-form')
    let data = new FormData(form)

    HTTP({
        method: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data
    }).then(
        response => authorize(data.get('continue'), response.data.access_token)
    ).catch(
        error => console.dir(error)
    )
}

function authorize(server, access_token) {
    window.location.replace(`${server}&token=${access_token}`)
}

function init() {
    let login = document.getElementById('login-button')
    let register = document.getElementById('register-button')
    let logout = document.getElementById('logout-button')
    let recovery = document.getElementById('recovery-button')
    let reset = document.getElementById('reset-button')

    if (null !== login) login.addEventListener('click', loginSubmit)
    if (null !== register) register.addEventListener('click', registerSubmit)
    if (null !== logout) logout.addEventListener('click', logoutSubmit)
    if (null !== recovery) recovery.addEventListener('click', recoverySubmit)
    if (null !== reset) reset.addEventListener('click', resetSubmit)
}

window.onload = init
