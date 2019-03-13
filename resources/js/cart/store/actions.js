export default {
    changeLoading(context, payload) {
        context.commit('CHANGE_LOADING', payload)
    },
    changeCart(context, payload) {
        context.commit('CHANGE_CART', payload)
    },
    setUser(context, payload) {
        context.commit('SET_USER', payload)
    },
    setInstallment(context, payload) {
        context.commit('SET_INSTALLMENT', payload)
    }
}
