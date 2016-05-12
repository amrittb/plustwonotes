import Mdl from 'material-design-lite';
import Vue from 'vue';
import VueResource from 'vue-resource';

import store from "./vuex/store";

import MdlCheckbox from "./Components/Checkbox.vue";
import RoleEditor from "./Components/RoleEditor.vue";
import UserRoles from "./Components/UserRoles.vue";

Vue.config.debug = true;

Vue.use(VueResource);

Vue.component("mdl-checkbox",MdlCheckbox);
Vue.component("role-editor",RoleEditor);
Vue.component("user-roles",UserRoles);

/**
 * Root Vue Instance.
 */
window.app = new Vue({
    el : 'body',
    store
});