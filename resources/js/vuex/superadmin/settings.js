import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        municipility_data: [],
        location_data: [],
        designation_data: [],
        branch_data: [],
        bank_data: [],

    },
    mutations: {
        SET_DEPARTMENT_DATA(state, list_data) {
            state.designation_data = list_data;
        },
        SET_LOCATION_DATA(state, list_data) {
            state.location_data = list_data;
        },
        SET_BRANCH_DATA(state, list_data) {
            state.branch_data = list_data;
        },
        SET_MUNICIPILITY_DATA(state, list_data) {
            state.municipility_data = list_data;
        },

    },
    getters: {
        get_department_list(state) {
            return state.designation_data.filter(function (item) {
                return item.type == 1;
            })

        },
        get_designation_list(state){
            return state.designation_data.filter(function (item) {
                return item.type == 2;
            })
        },
        get_division_list(state){
            return state.location_data.filter(function (item) {
                return item.type == 1;
            })
        }
    },
    actions: {
        async setDepartmentData(context) {
            let data = [];
            await axios.get('/department')
                .then((response) => {
                    data = response.data;
                    context.commit('SET_DEPARTMENT_DATA', response.data.data)
                })
            return data;
        },
        async setLocationData(context) {
            let data = [];
           await axios.get('/location')
            .then((response) => {
                data = response.data;
                context.commit('SET_LOCATION_DATA', response.data.data)
            })
            return data;

        },
        async setBranchData(context) {
            let data = [];
            await axios.get('/branch')
                .then((response) => {
                    data = response.data;
                    context.commit('SET_BRANCH_DATA', response.data.data)
                })
            return data;
        },
        async setmunicipilityData(context) {
            let data = [];
            await axios.get('/municipility')
                .then((response) => {
                    data = response.data;
                    context.commit('SET_MUNICIPILITY_DATA', response.data.data)
                })
            return data;
        },

    }
})

