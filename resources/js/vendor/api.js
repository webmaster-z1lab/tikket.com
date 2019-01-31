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
 * @returns {Promise<any>}
 */
export async function getJsonChart(url) {
    try {
        let promise = new Promise((resolve, reject) => {
            axios.get(url).then(result => {
                resolve(result);
            })
        });

        return await promise
    } catch (error) {
        console.error(error);
    }
}

/**
 * @param parameter
 * @returns {Promise<any>}
 */
export async function getCEP(parameter) {
    try {
        let promise = new Promise((resolve, reject) => {
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

            instance.get(`https://viacep.com.br/ws/${parameter}/json/`).then(result => {
                resolve(result);
            })
        });

        return await promise
    } catch (error) {
        console.error(error);
    }
}

/**
 * @returns {Promise<any>}
 */
export async function getStates() {
    try {
        let promise = new Promise((resolve, reject) => {
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

            instance.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados`).then(result => {
                resolve(result);
            })
        });

        return await promise
    } catch (error) {
        console.error(error);
    }
}

/**
 * @param parameter
 * @returns {Promise<any>}
 */
export async function getCities(parameter) {
    try {
        let promise = new Promise((resolve, reject) => {
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

            instance.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${parameter}/municipios`).then(result => {
                resolve(result);
            })
        });

        return await promise
    } catch (error) {
        console.error(error);
    }
}

/**
 * @param cardBin
 * @returns {Promise<any>}
 */
export async function getBrand(cardBin) {
    return await new Promise((resolve, reject) => {
        PagSeguroDirectPayment.getBrand({
            cardBin: cardBin,
            success: (response) => {
                resolve(response)
            },
            error: (error) => {
                reject(error)
            }
        })
    });
}

/**
 * @param cardNumber
 * @param cardBrand
 * @param cardCVV
 * @param cardExpirationDate
 * @returns {Promise<any>}
 */
export async function createCardToken(cardNumber, cardBrand, cardCVV, cardExpirationDate) {
    return await new Promise((resolve, reject) => {
        PagSeguroDirectPayment.createCardToken({
            cardNumber: cardNumber,
            brand: cardBrand,
            cvv: cardCVV,
            expirationMonth: cardExpirationDate.split('/')[0],
            expirationYear: cardExpirationDate.split('/')[1],
            success: (response) => resolve(response),
            error: (error) => reject(error)
        })
    });
}

/**
 * @returns {Promise<any>}
 */
export async function createCardHash() {
    return await new Promise((resolve, reject) => {
        PagSeguroDirectPayment.onSenderHashReady(function(response){
            if(response.status == 'error') {
                reject(response.message)
            }

            resolve(response.senderHash)
        });
    });
}
