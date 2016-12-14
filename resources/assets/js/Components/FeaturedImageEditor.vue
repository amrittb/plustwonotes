<template>
    <div class="featured-image-editor mdl-js-button mdl-js-ripple-effect" @click.stop.prevent="openMediaAttacher">
        <div class="featured-image-editor__label mdl-typography--text-center" v-show="!hasImage">
            <div class="mdl-spinner mdl-js-spinner is-active" v-show="isLoadingImage"></div>

            <h6 class="text--light mdl-typography--text-center" v-show="!isLoadingImage">Select a featured image for this post.</h6>
        </div>
        <img class="featured-image-editor__img" :src="src" v-show="hasImage">
        <a class="mdl-js-button mdl-js-ripple-effect featured-image-editor__img-remove-btn text--color-white" @click.stop.prevent="removeFeaturedImage" v-show="hasImage">
            <i class="material-icons">clear</i>
        </a>
        <input type="hidden" name="featured_img" :value="featuredImageName" />
    </div>
</template>

<script>
    import { getFeaturedImage } from "../vuex/getters";
    import { openMediaAttachment, syncFeaturedImageEditor, clearFeaturedImageInEditor } from "../vuex/actions";
    import { ATTACHMENT_MODE_FEATURED_IMAGE, FEATURED_IMAGE_ASPECT_RATIO } from "../constants";

    export default {
        ready() {
            this.imgElement = this.$el.querySelector("img");

            this.resizeEditor();

            window.onresize = (e) => {
                this.resizeEditor();
            };

            this.imgElement.onload = (e) => {
                this.imgElement.removeAttribute("style");
                this.fitImage();
            };

            if(this.name != '') {
                this.syncFeaturedImageEditor(this.name);
            }
        },
        data() {
            return {
                imgElement: undefined,
            }
        },
        props: {
            name: {
                type: String,
                default: '',
                required: false,
            },
        },
        computed: {
            src() {
                if(this.featuredImage) {
                    this.name = '';

                    return (this.featuredImage.getFeaturedImage()) ? this.featuredImage.getFeaturedUrl() : this.featuredImage.getFullUrl();
                }

                return "";
            },
            hasImage() {
                return (this.featuredImage != undefined);
            },
            featuredImageName() {
                return (this.featuredImage) ? this.featuredImage.name : "";
            },
            isLoadingImage() {
                return (this.name != '' && this.featuredImage == undefined);
            },
        },
        methods: {
            resizeEditor() {
                let width = this.$el.offsetWidth;
                let height = width / FEATURED_IMAGE_ASPECT_RATIO;

                this.$el.setAttribute("style","height:" + height + "px;");

                this.fitImage();
            },
            fitImage() {
                let containerWidth = this.$el.offsetWidth;
                let containerHeight = containerWidth / FEATURED_IMAGE_ASPECT_RATIO;

                if(this.featuredImage) {
                    let imageWidth = this.featuredImage.getFullImage().width;
                    let imageHeight = this.featuredImage.getFullImage().height;

                    let imageElementWidth = this.imgElement.width;
                    let imageElementHeight = this.imgElement.height;

                    let newImageWidth = containerWidth;
                    let newImageHeight = containerHeight;

                    let imageAspectRatio = (imageWidth / imageHeight);

                    if(imageAspectRatio < FEATURED_IMAGE_ASPECT_RATIO) {
                        newImageHeight = newImageWidth / imageAspectRatio;
                    } else {
                        newImageWidth = newImageHeight * imageAspectRatio;
                    }

                    this.imgElement.setAttribute("style","width:" + newImageWidth + "px;height:" + newImageHeight + "px;");

                }
            },
            openMediaAttacher() {
                this.openMediaAttachment({
                    mode: ATTACHMENT_MODE_FEATURED_IMAGE,
                });
            },
            removeFeaturedImage() {
                this.clearFeaturedImageInEditor();
            },
        },
        vuex: {
            getters: {
                featuredImage: getFeaturedImage,
            },
            actions: {
                openMediaAttachment,
                syncFeaturedImageEditor,
                clearFeaturedImageInEditor,
            },
        },
    }
</script>
