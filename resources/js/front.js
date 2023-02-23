import Vue from "vue";
import Vuex from "vuex";
import App from "./views/App";
import VueRouter from "vue-router";
import router from "./router.js";


import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import Vuelidate from 'vuelidate';
import { validationMixin } from 'vuelidate';

require('./app');

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);
Vue.use(Vuelidate);
// Vue.use(Notifications);

const store = new Vuex.Store({
  state: {
    isAuth: false,
    name: "REGISTRATI",
    productCount: 0,
    total: 0.00,
    quantity: [],
  },
  mutations: {
    updateUser(state, user) {
      state.isAuth = user.isAuth;
      if (user.isAuth) {
        state.name = user.name;
        window.localStorage.setItem('user', user.name);
      }
    },
    updateCart(state, info) {
      state.productCount = info.productCount;
      state.total = info.total;
    },
    currentQuantity(state, info) {
      state.quantity = info.quantity;
    }
  },
  getters: {
    getUser (state) {
        return state.name;
    },
    checkAuth (state) {
        return state.isAuth;
    }
  },
  actions: {
  },
  modules: {},
});

window.axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (error.response.status === 401 || error.response.status === 419) {
        window.location.href = '/login'
    }

    return Promise.reject(error)
})


const app = new Vue({
  el: "#app",
  vuetify: new Vuetify(),
  mixins: [validationMixin],
  render: (h) => h(App),
  router,
  store,
});
