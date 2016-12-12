export default class ImageFile {

    /**
     * Returns the size of image in KB.
     *
     * @returns {string}
     */
    getSizeInKb() {
        return Math.floor(this.size / 1024) + "KB";
    }

    /**
     * Returns thumbnail of the image.
     *
     * @returns {*}
     */
    getThumbnailImage() {
        return this.thumbnail;
    }

    /**
     * Returns Thumbnail Url.
     *
     * @returns {*}
     */
    getThumbnailUrl() {
        if( ! this.thumbnail) {
            return "";
        }

        return this.thumbnail.url;
    }

    /**
     * Returns full image.
     * @returns {*}
     */
    getFullImage() {
        return this.full;
    }

    /**
     * Returns Full Url.
     *
     * @returns {*}
     */
    getFullUrl() {
        if( ! this.full) {
            return "";
        }

        return this.full.url;
    }

    /**
     * Returns featured image.
     *
     * @returns {*}
     */
    getFeaturedImage() {
        return this.featured;
    }

    /**
     * Returns Featured Image URL.
     *
     * @returns {*}
     */
    getFeaturedUrl() {
        if( ! this.featured) {
            return "";
        }

        return this.featured.url;
    }
}