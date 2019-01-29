import {HTTP, getCookie} from "../bootstrap"
import httpBuildQuery from 'http-build-query'

/**
 * @returns {string}
 */
export function searchID() {
    let path = window.location.pathname;
    let arr = path.split('/');
    return arr[arr.length - 1];
}

/**
 * @param url
 * @param params
 * @returns {Promise<any>}
 */
export async function toSeek(url, params = null) {

    if(params !== null) url = url + '?' + httpBuildQuery(params)

    return await new Promise((resolve, reject) => {
        HTTP.get(url).then(
            response => resolve(response.data)
        ).catch(
            e => reject(e)
        )
    })
}

/**
 * @param url
 * @param dataForm
 * @param _method
 * @param headers
 * @returns {Promise<any>}
 */
export async function sendAuth(url, dataForm, _method, headers = {}) {
    let data = new FormData()

    for (let key in dataForm) {
        data.set(key, dataForm[key])
    }

    return await new Promise((resolve, reject) => {
        let instance = axios.create({
            transformRequest: [
                (data, headers) => {
                    delete headers.common['X-CSRF-TOKEN']
                    delete headers.common['Authorization']
                    delete headers.common['ID-TOKEN']
                    return data
                },
            ]
        })

        instance({
            method: _method,
            url: url,
            data: data,
            headers: headers
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

/**
 * @param url
 * @param dataForm
 * @param _method
 * @param headers
 * @param attachment
 * @returns {Promise<any>}
 */
export async function sendCommon(url, dataForm, _method, headers = {}, attachment = null) {
    let data = new FormData()

    for (let key in dataForm) {
        data.set(key, dataForm[key])
    }
    if (attachment !== null)
        data.append('attachment', attachment.file, attachment.file.name)

    return await new Promise((resolve, reject) => {
        HTTP({
            method: _method,
            url: url,
            data: data,
            headers: headers
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

/**
 * @returns {Promise<any>}
 */
export async function refreshData() {
    return await new Promise((resolve, reject) => {
        HTTP.post(route('openid.refresh')).then(
            response => {
                window.axios.defaults.headers.common['Authorization'] = `Bearer ${getCookie('auth_token')}`
                window.axios.defaults.headers.common['ID-TOKEN'] = getCookie('id_token')
                resolve(response)
            }
        ).catch(
            error => {
                reject(error)
            }
        )
    })
}

/**
 * @returns {string}
 */
export function askForToken() {
    let query = httpBuildQuery({
        client_id: process.env.MIX_CLIENT_ID,
        redirect_uri: strFinish(process.env.MIX_APP_URL) + 'openid/callback',
        response_type: 'code',
        scope: 'openid'
    })

    return strFinish(process.env.MIX_AUTH_SERVER) + `oauth/authorize?${query}`;
}

/**
 * @param url
 * @param params
 */
export function redirectURL(url, params) {
    let query = httpBuildQuery(params)

    window.location.href = url + '?' + query;
}

/**
 * @param url
 * @param data
 * @param headers
 * @returns {Promise<any>}
 */
export function submitFormVue(url, data, headers = {}) {

    return new Promise((resolve, reject) => {
        HTTP({
            method: 'POST',
            url: url,
            data: data,
            headers: headers
        }).then(
            response => {
                resolve(response)
            }
        ).catch(
            error => {
                reject(error)
            }
        )
    })
}

/**
 * @param text
 * @returns {Promise<any>}
 */
function strFinish(text) {
    if (!text.endsWith('/')) {
        return text + '/'
    }

    return text
}

/**
 * @param url
 * @param params
 * @returns {Promise<any>}
 */
export async function sendAPIPOST(url, params) {
    let promise = new Promise((resolve, reject) => {
        HTTP.post(url, params).then(result => resolve(result)).catch((error) => reject(error))
    });

    return await promise
}

/**
 * @param url
 * @param config
 * @returns {Promise<any>}
 */
export async function sendAPIDELETE(url, config = {}) {
    let promise = new Promise((resolve, reject) => {
        HTTP.delete(url, config).then(result => resolve(result)).catch((error) => reject(error))
    });

    return await promise
}
