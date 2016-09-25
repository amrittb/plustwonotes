<template>
    <form :id="id"
          :name="name"
          method="post"
          :action="imageUploadUrl"
          enctype="multipart/form-data"
          :class="classNames" class="media-uploader">
        <div class="media-uploader__form-group">
            <input multiple type="file"
                   id="attachments"
                   name="attachments[]"
                   @change.self="uploadAttachments"
                   class="media-uploader__file-input"
                   accept="image/jpeg, image/png, image/gif, *.jpg, *.jpeg, *.png, *.gif">
            <label for="attachments"
                   class="media-uploader__facade-button">
                <i class="material-icons">backup</i><br /> Upload Image
                <span class="media-uploader__facade-button media-uploader__cancel-button"
                      @click.stop.prevent="cancelUpload"
                      v-if="isUploading">
                    {{ numFiles }} files uploading...
                    <i class="material-icons">cancel</i> Cancel Upload
                </span>
                <span class="media-uploader__facade-button media-uploader__processing-button"
                      v-show="isProcessing">
                    <p>
                        <span class="mdl-spinner mdl-js-spinner is-active"></span>
                    </p>
                    Processing...
                </span>
            </label>
            <div class="media-uploader__progress">
                <mdl-progress-bar v-show="isUploading"></mdl-progress-bar>
            </div>
        </div>
    </form>
</template>

<script>
    import { syncImages, showSuccessSnackbar, showErrorSnackbar } from "../../vuex/actions";

    export default {
        ready() {
            this.attachmentElement = this.$el.querySelector('input[type="file"]');
        },
        data() {
            return {
                isUploading: false,
                isProcessing: false,
                hasUploadErrors: false,
                numFiles: 0,
                files: {}
            }
        },
        props: {
            id: {
                type: String,
                required: false
            },
            name: {
                type: String,
                required: false
            },
            classNames: {
                type: String,
                required: false
            },
            imageUploadUrl: {
                type: String,
                required: true
            },
        },
        methods: {

            /**
             * Uploads Attachments to server.
             *
             * @param e
             */
            uploadAttachments(e) {
                if(!e.target.files.length) {
                    return;
                }

                this.files = e.target.files;
                this.numFiles = this.files.length;

                this.uploadFiles(this.files);
            },

            /**
             * Uploads files to server.
             *
             * @param files
             */
            uploadFiles(files) {
                let self = this;
                let data = new FormData();

                for(let key in files) {
                    data.append('files[' + key + ']',files[key]);
                }

                this.isUploading = true;
                this.updateProgressBar(0);

                this.$http.post(this.imageUploadUrl,data, {
                    before(request) {
                        self.request = request;
                    },
                    progress(e) {
                        if (e.lengthComputable) {
                            let completed = e.loaded / e.total * 100;
                            self.updateProgressBar(completed);
                            if(completed === 100 && !self.isProcessing) {
                                self.isProcessing = true;
                            }
                        }
                    }
                }).then((response) => {
                    this.resetUploadForm();
                    if(response.data.total === 0) {
                        this.showUploadError();
                    } else {
                        this.syncImages(response.data.images);
                        this.showUploadSuccess(response.data.total);
                    }
                }, (response) => {
                    this.resetUploadForm();
                    this.showUploadError(response);
                });
            },

            /**
             * Updates Progressbar.
             *
             * @param val
             */
            updateProgressBar(val) {
                this.$broadcast("ProgressBar.Update",val);
            },

            /**
             * Resets upload form.
             */
            resetUploadForm() {
                this.isProcessing = false;
                this.isUploading = false;
                this.attachmentElement.value = "";
            },

            /**
             * Shows upload success snackbar.
             *
             * @param numUploaded
             */
            showUploadSuccess(numUploaded) {
                this.showSuccessSnackbar(numUploaded + " out of " + this.numFiles + " files uploaded successfully.");
            },

            /**
             * Shows upload errors.
             *
             * @param response
             */
            showUploadError(response) {
                let errorMessage = [ this.numFiles + " files could not be uploaded." ];

                if(response.status === 422) {
                    errorMessage.push("File type not supported or file size exceeded limit.");
                }

                this.showErrorSnackbar(errorMessage.join(""));
            },

            /**
             * Cancels upload.
             */
            cancelUpload() {
                this.isUploading = false;
                this.cancelLastRequest();
            },

            /**
             * Cancels Last request.
             */
            cancelLastRequest() {
                if(this.request) {
                    this.request.abort();
                }
            }
        },
        vuex: {
            actions: {
                syncImages,
                showSuccessSnackbar,
                showErrorSnackbar,
            }
        }
    }
</script>