<template>
    <div class="post__featured-img">
        <img class="img--responsive post__featured-img--thumbnail post__featured-img-image" :src="thumbnailSrc" v-show="isThumbnailLoaded && !isFullImageLoaded">
        <img class="img--responsive post__featured-img--full post__featured-img-image" :src="src" :alt="alt" v-show="isFullImageLoaded">
    </div>
</template>

<script>
    import { FEATURED_IMAGE_ASPECT_RATIO } from "../constants";

    export default{
        ready() {
            this.imgElement = this.$el.querySelector(".post__featured-img--full");
            this.thumbnailElement = this.$el.querySelector(".post__featured-img--thumbnail");

            this.resizeImage();

            this.imgElement.onload = (e) => {
                this.resizeImage();
                this.isFullImageLoaded = true;
            };

            this.thumbnailElement.onload = (e) => {
                this.resizeImage();
                this.isThumbnailLoaded = true;
            };

            window.onresize = (e) => {
                this.resizeImage();
            };
        },
        data() {
            return {
                imgElement: undefined,
                thumbnailElement: undefined,
                isThumbnailLoaded: false,
                isFullImageLoaded: false,
            }
        },
        props: {
            src: {
                type: String,
                required: true,
            },
            thumbnailSrc: {
                type: String,
                required: true,
            },
            alt: {
                type: String,
                required: true,
            },
        },
        methods: {
            resizeImage() {
                this.$el.removeAttribute("style");

                let containerWidth = (this.$el.offsetWidth + 32);

                containerWidth = (containerWidth < 960) ? containerWidth : 960;

                let containerHeight = containerWidth / FEATURED_IMAGE_ASPECT_RATIO;

                let leftOffset = (containerWidth === 960) ? 0 : -16;

                this.$el.setAttribute("style","width:" + containerWidth + "px;height:" + containerHeight + "px;left:" + leftOffset + "px;");
            },
        },
    }
</script>
