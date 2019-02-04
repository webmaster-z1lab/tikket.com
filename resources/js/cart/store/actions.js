export default {
    changeCart(context, payload) {
        context.commit('CHANGE_CART', payload)
    },
    setUser(context, payload) {
        context.commit('SET_USER', payload)
    }
}
