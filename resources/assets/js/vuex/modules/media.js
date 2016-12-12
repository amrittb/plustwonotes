import {
        SYNC_IMAGES,
        REMOVE_IMAGE,
        SYNC_FEATURED_IMAGE_EDITOR,
        CLEAR_FEATURED_IMAGE_IN_EDITOR
} from "../mutation-types";

import ImageFile from "../../Models/ImageFile";
import ImageSize from "../../Models/ImageSize";

const state = {
    images: [],
    featuredImage: undefined,
};

const mutations = {

    /**
     *
     * @param state
     * @param images
     */
    [SYNC_IMAGES] (state,images) {
        for(let i in images) {
            let image = images[i];

            // Updates duplicate Image.
            let imageFile = (state.images.filter((img) => { return img.name === image.name }))[0];

            if(!imageFile) {
                imageFile = new ImageFile();
            }

            imageFile.name = image.name;
            imageFile.size = image.size;
            imageFile.lastModified = image.last_modified;
            imageFile.lastModifiedTimestamp = image.last_modified_timestamp;

            let sizes = ['full','thumbnail','featured','featured_thumbnail'];

            for(let j in sizes) {
                let sizeName = sizes[j];

                if(image[sizeName]) {
                    if( ! imageFile[sizeName]) {
                        imageFile[sizeName] = new ImageSize();
                    }

                    imageFile[sizeName].url = image[sizeName].url;
                    imageFile[sizeName].width = image[sizeName].width;
                    imageFile[sizeName].height = image[sizeName].height;
                }
            }

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
        if((state.featuredImage != undefined) && (image.name === state.featuredImage.name)) {
            state.featuredImage = undefined;
        }
    },


    /**
     * Syncs Featured image.
     *
     * @param state
     * @param imageName
     */
    [SYNC_FEATURED_IMAGE_EDITOR] (state, imageName) {
        state.featuredImage = imageName;
    },

    /**
     * Clears Featured image.
     *
     * @param state
     */
    [CLEAR_FEATURED_IMAGE_IN_EDITOR] (state) {
        state.featuredImage = undefined;
    },
};

export default {
    state,
    mutations
};
