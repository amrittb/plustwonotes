import { SYNC_IMAGES, REMOVE_IMAGE } from "../mutation-types";
import ImageFile from "../../Models/ImageFile";

const state = {
    images: [],
};

const mutations = {

    /**
     *
     * @param state
     * @param images
     */
    [SYNC_IMAGES] (state,images) {
        for(let key in images) {
            let image = images[key];

            // Updates duplicate Image.
            let duplicate = (state.images.filter((img) => { return img.name === image.name }))[0];
            if(duplicate) {
                duplicate.size = image.size;
                duplicate.publicUrl = image.public_url;
                duplicate.thumbnailUrl = image.thumbnail_url;
                duplicate.lastModified = image.last_modified;
                duplicate.lastModifiedTimestamp = image.last_modified_timestamp;
                continue;
            }

            let imageFile = new ImageFile(image.name,
                                            image.public_url,
                                            image.thumbnail_url,
                                            image.size,
                                            image.last_modified_timestamp,
                                            image.last_modified);
            state.images.push(imageFile);
        }
    },

    /**
     * Removes an image from media store.
     *
     * @param state
     * @param image
     */
    [REMOVE_IMAGE] (state,image) {
        state.images.splice(state.images.indexOf(image),1);
    }
};

export default {
    state,
    mutations
};
