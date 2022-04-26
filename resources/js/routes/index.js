import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../views/Login'
import Deshboard from '../views/Deshboard'
import Depertment from '../views/Department.vue'
import Branch from '../views/Branch'
import BDLocation from '../views/Location.vue'
import EmployeeQuota from '../views/EmployeeQuota'
import Municipility from '../views/Municipility.vue'
import BankBranch from '../views/BankBranch.vue'




const router = new VueRouter({
    mode: 'history',
    base: (process.env.MIX_VUE_ENV == "local") ? '/promise/' : '',
    linkExactActiveClass: "active",
    routes: [
        {
            path: '/login',
            name: 'login',
            meta: {isShowOtherComponent: false},
            component: Login
        },
        {path: '/', name: 'deshborad', component: Deshboard, beforeEnter: authGuard},
        {path: '/department', name: 'department', component: Depertment, beforeEnter: authGuard},
        {path: '/branch', name: 'branch', component: Branch, beforeEnter: authGuard},
        {path: '/location', name: 'location', component: BDLocation, beforeEnter: authGuard},
        {path: '/employee/quota', name: 'employee.quota', component: EmployeeQuota, beforeEnter: authGuard},
        {path: '/municipility', name: 'municipility', component: Municipility, beforeEnter: authGuard},
        {path: '/bank/branch', name: 'bank_branch', component: BankBranch, beforeEnter: authGuard},

    ]
});

function authGuard(to, from, next) {
    if (!auth.loggedIn()) {
        next({name: 'login'});
    }
    next();
}


export default router;
