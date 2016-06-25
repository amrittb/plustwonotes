import Mdl from 'material-design-lite';
import Vue from 'vue';
import VueResource from 'vue-resource';

import store from "./vuex/store";

import FormDateTimePicker from "./Components/FormDateTimePicker.vue";
import MediumEditor from "./Components/MediumEditor.vue";
import RoleEditor from "./Components/RoleEditor.vue";
import PostEditor from "./Components/PostEditor.vue";
import MdlCheckbox from "./Components/Checkbox.vue";
import UserRoles from "./Components/UserRoles.vue";

Vue.config.debug = true;

Vue.use(VueResource);

Vue.component("form-date-picker",FormDateTimePicker);
Vue.component("medium-editor",MediumEditor);
Vue.component("mdl-checkbox",MdlCheckbox);
Vue.component("post-editor",PostEditor);
Vue.component("role-editor",RoleEditor);
Vue.component("user-roles",UserRoles);

/**
 * Root Vue Instance.
 */
window.app = new Vue({
    el : 'body',
    store
});