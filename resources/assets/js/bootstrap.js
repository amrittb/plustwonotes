import Vue from 'vue';
import VueResource from 'vue-resource';

import AuthManager from "./Auth/Auth";

window.Vue = Vue;
window.store = require("./vuex/store");

Vue.config.debug = true;

Vue.use(VueResource);

window.authManager = new AuthManager();

Vue.http.interceptors.push((request,next) => {
    authManager.attachAuthenticationHeader(request,next);
    next((response) => {
        if(response.headers.get("Authorization")) {
            authManager.refreshTokenFromResponse(response);
        }
    });
});

import FeaturedImage from "./Components/FeaturedImage.vue";

import RoleEditor from "./Components/RoleEditor.vue";
import UserRoles from "./Components/UserRoles.vue";

import MdlSnackbar from "./Components/Material/Snackbar.vue";
import MdlCheckbox from "./Components/Material/Checkbox.vue";
import MdlProgressBar from "./Components/Material/ProgressBar.vue";

Vue.component("featured-image", FeaturedImage);
Vue.component("role-editor",RoleEditor);
Vue.component("user-roles",UserRoles);

Vue.component("mdl-snackbar",MdlSnackbar);
Vue.component("mdl-checkbox",MdlCheckbox);
Vue.component("mdl-progress-bar",MdlProgressBar);