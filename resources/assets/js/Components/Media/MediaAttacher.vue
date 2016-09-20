<template>
    <dialog id="media-attachment-dialog" class="mdl-dialog media-attachment">
        <h4 class="mdl-dialog__title text--thin">Attach a media</h4>
        <div class="mdl-dialog__content media-attachment__content">
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__tab-bar">
                    <a href="#images-panel" class="mdl-tabs__tab is-active">
                        Images
                        <div class="mdl-spinner mdl-js-spinner is-active" v-show="isLoadingImages"></div>
                    </a>
                </div>

                <div class="mdl-tabs__panel is-active" id="images-panel">
                    <div class="media-images">
                        <div class="media-images__content">
                            <div class="media-images__thumbnail-container">
                                <image-uploader :image-upload-url="imageUploadUrl"
                                                      class-names="media-images__thumbnail">
                                </image-uploader>
                                <div class="media-images__thumbnail media-images__thumbnail-retry"
                                     v-if="canRetry">
                                    <div>
                                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                                                type="button"
                                                @click.prevent="retryImageLoading">
                                            <i class="material-icons">refresh</i>
                                        </button>
                                    </div>
                                </div>
                                <media-thumbnail v-for="image in images | orderBy 'last_modified_timestamp' -1"
                                                 :image="image"
                                                 @click="selectImage(image)"
                                                 :is-selected="isSelected(image)">
                                </media-thumbnail>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdl-dialog__actions media-attachment__actions">
            <button type="button" class="mdl-button" @click.prevent="attachMedia()">Attach</button>
            <button type="button" class="mdl-button" @click="closeDialog()">Cancel</button>
            <button type="button" class="mdl-button" @click="deleteImage()" v-show="selectedImage !== null">
                Delete
                <div class="mdl-spinner mdl-js-spinner is-active" v-show="isDeleting"></div>
            </button>
        </div>
    </dialog>
</template>

<script>
    import { getImages, getDialogPolyFill } from "../../vuex/getters";
    import { syncImages, removeImage } from "../../vuex/actions";

    export default {
        ready() {
            if( ! this.$el.showModal){
                this.dialogPolyFill.registerDialog(this.$el);
            }

            this.resource = this.$resource(this.imageResourceUrl + "/{image}",{},{
                index: {
                    method: 'GET',
                    url: this.imageResourceUrl
                }
            });

            this.loadImages();
        },
        data() {
            return {
                isLoadingImages: false,
                canRetry: false,
                isDeleting: false,
                selectedImage: null,
                selection: null
            };
        },
        props: {
            imageResourceUrl: {
                type: String,
                required: true
            },
            imageUploadUrl: {
                type: String,
                required: true
            }
        },
        methods: {

            /**
             * Fires an Event to attach the image.
             */
            attachMedia() {
                this.selection.dispatchEvent(new CustomEvent("MediaAttacher.attachImage",{
                    'detail': this.selectedImage
                }));
                this.closeDialog();
            },

            /**
             *  Opens the Modal Dialog.
             */
            openDialog() {
                this.$el.showModal();
            },

            /**
             * Closes the Modal Dialog.
             */
            closeDialog() {
                this.$el.close();
                this.selection = null;
                this.selectedImage = null;
                this.$emit('MediaAttacher.Close');
            },

            /**
             * Loads images data from server.
             */
            loadImages() {
                let self = this;
                this.resource.index({
                    before(request) {
                        self.isLoadingImages = true;
                    },
                }).then((response) => {
                    this.isLoadingImages = false;
                    this.syncImages(response.data.images);
                },function(response) {
                    this.isLoadingImages = false;
                    this.showErrors();
                });
            },

            /**
             * Displays image loading errors.
             */
            showErrors() {
                this.canRetry = true;
            },

            /**
             * Retries image loading.
             */
            retryImageLoading() {
                this.canRetry = false;
                this.loadImages();
            },

            /**
             * Selects a given image.
             *
             * @param image
             */
            selectImage(image) {
                this.selectedImage = image;
            },

            /**
             * Checks if the given image is selected.
             *
             * @param image
             * @returns {boolean}
             */
            isSelected(image) {
                if(this.selectedImage) {
                    return this.selectedImage.name === image.name;
                }
                return false;
            },

            /**
             * Deletes an image from server.
             */
            deleteImage() {
                let self = this;

                self.isDeleting = true;
                
                this.resource.delete({
                    image: this.selectedImage.name
                }).then(() => {
                    self.isDeleting = false;
                    this.$broadcast("Snackbar.ShowSuccess","Image deleted successfully.");
                    this.removeImage(this.selectedImage);
                    this.resetSelection();
                },() => {
                    self.isDeleting = false;
                    this.$broadcast("Snackbar.ShowError","Image could not be deleted.");
                });
            },

            /**
             * Resets the image selection.
             */
            resetSelection() {
                this.selectedImage = null;
            }
        },
        events: {
            /**
             * Opens MediaAttacher dialog.
             *
             * @param selection
             * @constructor
             */
            'MediaAttacher.Open' : function(selection) {
                this.selection = selection;
                this.openDialog();
            }
        },
        vuex: {
            getters: {
                images: getImages,
                dialogPolyFill: getDialogPolyFill,
            },
            actions: {
                syncImages,
                removeImage,
            },
        },
    }
</script>