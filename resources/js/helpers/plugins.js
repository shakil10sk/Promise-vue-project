import Vue from 'vue';

import Auth from '../classes/Auth'
window.auth = Auth;

// ====== Chart js ========  //

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)
Vue.component('apexchart', VueApexCharts)

// =============== axios ================== //
import {axios,axiosWithoutToken} from '../plugins/axios'
window.axios = axios;
window.axiosWithoutToken = axiosWithoutToken;

// ============= vuex ================== //
import settings from '../vuex/superadmin/settings'
window.SettingVeux = settings;

// ============= simple validator ================== //
import SimpleVueValidation from 'simple-vue-validator';
window.Validator = SimpleVueValidation.Validator;
Vue.use(SimpleVueValidation);

// ============= sweetAlert ================== //
import swal from 'sweetalert2';
window.Swal = swal;

// =============== global component ========== //

import Spinner from "../components/Spinner";
Vue.component('spinner',Spinner);

import Modal from "../components/Modal";
Vue.component('Modal',Modal);

import EditModal from "../components/EditModal";

Vue.component('EditModal',EditModal);


import BaseTable from "../components/BaseTable";
Vue.component('baseTable',BaseTable)

import Pagination from "../components/Pagination";
Vue.component('pagination',Pagination);

import SearchTableData from "../components/SearchTableData";
Vue.component('SearchTableData',SearchTableData);

import LegthMenu from "../components/LegthMenu";
Vue.component('LegthMenu',LegthMenu);

// datapicker  //
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

Vue.component('DatePicker',DatePicker);




