import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

import defaults from "./modules/defaults";
import users from "./modules/users";

export default new Vuex.Store({
    modules: {
        defaults,
        users
    }
});