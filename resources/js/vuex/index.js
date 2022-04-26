import Vue from 'vue'
import Vuex from 'vuex'
import LocalStorage from '../classes/LocalStorage'
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        user: null,

    },
    mutations: {
        setUserData(state,loginData){
            state.user = loginData.user;
            auth.SetData(loginData)

        },
        clearUserData () {
            auth.clear()
            window.location.replace(process.env.MIX_VUE_URL+ '/login');
        },
    },
    actions: {
        login({commit},loginData){
            commit('setUserData',loginData)
        },
        logout({commit}){
            commit('clearUserData')
        }
    }
})

export default store;
