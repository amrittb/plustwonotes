import Mdl from 'material-design-lite';
import Vue from 'vue';
import VueResource from 'vue-resource';

import store from "./vuex/store";

import FormDateTimePicker from "./Components/FormDateTimePicker.vue";
import ImageUploader from "./Components/Media/ImageUploader.vue";
import MediaThumbnail from "./Components/Media/MediaThumbnail.vue";
import MediaAttacher from "./Components/Media/MediaAttacher.vue";
import RoleEditor from "./Components/RoleEditor.vue";
import PostEditor from "./Components/PostEditor.vue";
import UserRoles from "./Components/UserRoles.vue";

import MdlSnackbar from "./Components/Material/Snackbar.vue";
import MdlCheckbox from "./Components/Material/Checkbox.vue";
import MdlProgressBar from "./Components/Material/ProgressBar.vue";

Vue.config.debug = true;

Vue.use(VueResource);

var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');

Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;

Vue.component("image-uploader",ImageUploader);
Vue.component("form-date-picker",FormDateTimePicker);
Vue.component("media-attacher",MediaAttacher);
Vue.component("media-thumbnail",MediaThumbnail);
Vue.component("post-editor",PostEditor);
Vue.component("role-editor",RoleEditor);
Vue.component("user-roles",UserRoles);

Vue.component("mdl-snackbar",MdlSnackbar);
Vue.component("mdl-checkbox",MdlCheckbox);
Vue.component("mdl-progress-bar",MdlProgressBar);

/**
 * Root Vue Instance.
 */
window.app = new Vue({
    el : 'body',
    store
});