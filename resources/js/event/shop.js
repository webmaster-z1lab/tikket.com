'use strict'

import {HTTP} from "../bootstrap"
import LocalStorage from "../vendor/storage"
import moment from 'moment'

const entrances = document.querySelectorAll('.entrance')
const btnAction = document.querySelector('.js-action')

let total = 0
let amount = 0

/**
 * Init function
 *
 * Add buttons and form listeners and events
 */
function init() {
    for (let entrance of entrances) {
        let btnMinus = entrance.firstElementChild.firstElementChild
        let btnPlus = entrance.lastElementChild.firstElementChild

        let input, value, max;

        for (let i = 0; i < entrance.children.length; i++) {
            if (entrance.children[i].classList.contains('js-quantity')) {
                input = entrance.children[i]
                value = parseInt(input.value)

                !isNaN(value) ? amount += value : input.value = value = 0

                if (value > 0) {
                    for (let j = 0; j < value; j++) {
                        calcTotal(input.dataset.price, 'plus')
                    }
                }

                max = parseInt(input.dataset.max)
                checkButton(value, max, btnMinus, btnPlus)
                checkAction()
            }
        }

        btnMinus.addEventListener('click', function () {
            if (value > 0) {
                input.value = value -= 1
                amount -= 1
                calcTotal(input.dataset.price, 'minus')
            }

            checkButton(value, max, btnMinus, btnPlus)
            checkAction()
        })

        btnPlus.addEventListener('click', function () {
            if (value < max) {
                input.value = value = value + 1
                amount += 1
                calcTotal(input.dataset.price, 'plus')
            }

            checkButton(value, max, btnMinus, btnPlus)
            checkAction()
        })
    }

    let form = document.getElementById('shop')

    form.addEventListener('submit', function (e) {
        e.preventDefault()
        btnAction.disabled = true
        btnAction.classList.add('disabled')

        new LocalStorage().clear()

        submit(form).then(
            response => {
                new LocalStorage().clear()

                new LocalStorage('cart__').setItem('user', response.data, moment(response.data.attributes.expires_at).diff(moment(), 'seconds'))
                window.location.href = process.env.MIX_APP_URL + '/cart'
            }
        ).catch(
            error => {
                btnAction.disabled = false
                btnAction.classList.remove('disabled')

                if (_.isObject(error.response.data)) {
                    console.log(error.response.data.errors.detail)
                } else {
                    console.dir(error)
                }
            }
        ).finally(() => {
                Pace.stop()
            }
        )
    })
}

/**
 * Change the disabled status from minus and plus buttons
 *
 * @param value
 * @param max
 * @param btnMinus
 * @param btnPlus
 */
function checkButton(value, max, btnMinus, btnPlus) {
    if (value === 0) {
        btnMinus.disabled = true
        btnMinus.classList.add('disabled')
    } else if (btnMinus.disabled === true) {
        btnMinus.disabled = false
        btnMinus.classList.remove('disabled')
    }

    if (value === max) {
        btnPlus.disabled = true
        btnPlus.classList.add('disabled')
    } else if (btnPlus.disabled === true) {
        btnPlus.disabled = false
        btnPlus.classList.remove('disabled')
    }
}

/**
 * Change submit form button state
 */
function checkAction() {
    if (amount === 0) {
        btnAction.disabled = true
        btnAction.classList.add('disabled')
    } else if (btnAction.disabled === true) {
        btnAction.disabled = false
        btnAction.classList.remove('disabled')
    }
}

/**
 *
 * @param price
 * @param action
 */
function calcTotal(price, action) {
    if (action === 'minus') {
        total -= parseFloat(price)
    } else if (action === 'plus') {
        total += parseFloat(price)
    }

    document.querySelector('.js-total').innerHTML = formatMoney(total)
}

/**
 *
 * @param amount
 * @param decimalCount
 * @param decimal
 * @param thousands
 * @returns {string}
 */
function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
    try {
        decimalCount = Math.abs(decimalCount)
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount

        const negativeSign = amount < 0 ? "-" : ""

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString()
        let j = (i.length > 3) ? i.length % 3 : 0

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "")
    } catch (e) {
        console.log(e)
    }
}

/**
 *
 * @param form
 * @returns {Promise<any>}
 */
function submit(form) {
    let data = new FormData(form)
    let tickets = [];

    for (let entrance of entrances) {
        let quantity = parseInt(entrance.getElementsByClassName('js-quantity')[0].value)

        if (quantity > 0) {
            let lot = entrance.getElementsByClassName('js-lot')[0].value
            let entrance_id = entrance.getElementsByClassName('js-entrance')[0].value

            tickets.push({
                'lot': lot,
                'entrance': entrance_id,
                'quantity': quantity
            })
        }
    }

    for (let i = 0; i < tickets.length; i++) {
        data.set(`tickets[${i}][lot]`, tickets[i].lot)
        data.set(`tickets[${i}][entrance]`, tickets[i].entrance)
        data.set(`tickets[${i}][quantity]`, tickets[i].quantity)
    }

    return new Promise((resolve, reject) => {
        HTTP({
            method: 'POST',
            url: process.env.MIX_API_VERSION_ENDPOINT + '/carts',
            data: data
        }).then(
            response => {
                resolve(response.data)
            }
        ).catch(
            error => {
                reject(error)
            }
        )
    })
}

init()
