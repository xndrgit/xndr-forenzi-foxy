import Vue from "vue";
import App from "./views/App";
import VueRouter from "vue-router";
import store from './store/index.js';
import router from "./router.js";

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import Vuelidate, {validationMixin} from 'vuelidate';
import VBus from './utils/VBus.js';

require('./app');

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(Vuelidate);
// Vue.use(Notifications);

window.VBus = new VBus();

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
