import Vue from 'vue';
import VueResource from 'vue-resource';

import AuthManager from "./Auth/Auth";

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