import FormDateTimePicker from "./Components/FormDateTimePicker.vue";
import MediaAttacher from "./Components/Media/MediaAttacher.vue";
import ImageUploader from "./Components/Media/ImageUploader.vue";
import MediaThumbnail from "./Components/Media/MediaThumbnail.vue";
import PostEditor from "./Components/PostEditor.vue";
import FeaturedImageEditor from "./Components/FeaturedImageEditor.vue";

window.Vue.component("form-date-picker",FormDateTimePicker);
window.Vue.component("media-attacher",MediaAttacher);
window.Vue.component("image-uploader",ImageUploader);
window.Vue.component("media-thumbnail",MediaThumbnail);
window.Vue.component("post-editor",PostEditor);
window.Vue.component("featured-image-editor", FeaturedImageEditor);