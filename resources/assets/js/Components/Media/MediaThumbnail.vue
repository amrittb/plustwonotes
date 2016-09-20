<template>
    <div class="media-images__thumbnail">
        <img :src="image.thumbUrl"
             class="media-images__thumbnail-img"
             v-show="isLoaded"
             @load="showImage"
             @error="showRetry">
        <i class="material-icons media-images__thumbnail-selection" v-if="isSelected">check-circle</i>
        <div class="media-images__thumbnail-info">
            <span class="media-images__thumbnail-info-size">
                {{ image.getSizeInKb() }}
            </span>
            <span class="media-images__thumbnail-info-modified">
                {{ image.lastModified }}
            </span>
        </div>
        <div class="media-images__thumbnail-spinners">
            <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                    type="button"
                    @click.prevent="refreshImage"
                    v-if="canRetry">
                <i class="material-icons">refresh</i>
            </button>
            <div class="mdl-spinner mdl-js-spinner is-active" v-show="isLoading"></div>
        </div>
    </div>
</template>

<script>
    export default {
        ready() {
            this.img = this.$el.getElementsByTagName("img")[0];
        },
        props: {
            image: {
                type: Object,
                required: false,
            },
            isSelected: {
                type: Boolean,
                required: false,
                default: false,
            }
        },
        data() {
            return {
                isLoaded: false,
                isLoading: false,
                canRetry: false,
            };
        },
        methods: {
            /**
             * Loads an image from source.
             *
             * @param src
             */
            loadImage(src) {
                this.isLoading = true;
                this.thumbnailUrl = src;
            },

            /**
             * Shows loaded image.
             */
            showImage() {
                this.isLoaded = true;
                this.isLoading = false;
            },

            /**
             * Shows retry options.
             */
            showRetry() {
                this.isLoaded = false;
                this.isLoading = false;
                this.canRetry = true;
            },

            /**
             * Refreshes image by applying cache busting to request.
             */
            refreshImage() {
                this.canRetry = false;
                this.loadImage(this.thumbnailUrl + "#" + new Date().getTime());
            },
        }
    }
</script>