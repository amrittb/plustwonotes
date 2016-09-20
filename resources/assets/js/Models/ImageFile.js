import moment from "moment";

export default class ImageFile {

    /**
     * Creates an ImageFile Object.
     *
     * @param name
     * @param publicUrl
     * @param thumbUrl
     * @param size
     * @param lastModifiedTimestamp
     */
    constructor(name,publicUrl,thumbUrl,size,lastModifiedTimestamp,lastModified) {
        this.name = name;
        this.publicUrl = publicUrl;
        this.thumbUrl = thumbUrl;
        this.size = size;
        this.lastModifiedTimestamp = lastModifiedTimestamp;
        this.lastModified = lastModified;
    }

    /**
     * Returns the size of image in KB.
     *
     * @returns {string}
     */
    getSizeInKb() {
        return Math.floor(this.size / 1024) + "KB";
    }
}