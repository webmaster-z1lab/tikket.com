import {toSeek} from "../../vendor/common";

export default {
    async setDataBasic(context, payload) {
         await toSeek(route('openid.user')).then(
            data => context.commit('SET_DATA_BASIC', data)
        );
    },
    changeDataBasic(context, payload) {
        context.commit('CHANGE_DATA_BASIC', payload)
    }
}
