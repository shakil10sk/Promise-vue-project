(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./resources/js/vuex/superadmin/settings.js":
/*!**************************************************!*\
  !*** ./resources/js/vuex/superadmin/settings.js ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");


vue__WEBPACK_IMPORTED_MODULE_0___default.a.use(vuex__WEBPACK_IMPORTED_MODULE_1__["default"]);
var store = new vuex__WEBPACK_IMPORTED_MODULE_1__["default"].Store({
  state: {
    municipility_data: [],
    location_data: [],
    department_data: [],
    branch_data: [],
    bank_data: []
  },
  mutations: {
    SET_DEPARTMENT_DATA: function SET_DEPARTMENT_DATA(state, list_data) {
      state.department_data = list_data;
    }
  },
  getters: {},
  actions: {
    setDepartmentData: function setDepartmentData(_ref) {
      var commit = _ref.commit;
      axios.get('/department/list_data').then(function (response) {
        commit('SET_DEPARTMENT_DATA', response.data);
      });
    }
  }
});
/* harmony default export */ __webpack_exports__["default"] = (store);

/***/ })

}]);