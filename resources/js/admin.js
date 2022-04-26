import Vue from 'vue'

import AppLayout from './views/layouts/AppLayout'
require('./Helpers/plugins')
require('./mixins/mixins')
import router from  './routes/index'
import store from  './vuex/index'


const admin = new Vue({
    el: '#admin',
    router,
    store,
    data() {
        return {
            app_url: process.env.MIX_VUE_URL,
            asset_url: process.env.MIX_VUE_ASSET_URL,
        }
    },
    components: {'adminlayout': AppLayout},



})
