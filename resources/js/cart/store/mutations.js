export default {
    'CHANGE_LOADING' (state, payload) {
        state.isLoading = payload
    },
    'CHANGE_CART' (state, payload) {
        state.cart = payload
    },
    'SET_USER' (state, payload) {
        state.user = payload
    },
    'SET_INSTALLMENT' (state, payload) {
        state.installment = payload
    }
}
