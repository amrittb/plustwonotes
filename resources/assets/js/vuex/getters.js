/**
 * Returns roles that a user can have.
 *
 * @param state
 * @returns {Array|*}
 */
export function getRoles(state) {
    return state.defaults.Plustwonotes.roles;
}

/**
 * Returns this list of users.
 *
 * @param state
 * @returns {*|state.users|{}|vuex.getters.users|exports.default.vuex.getters.users}
 */
export function getUsers(state) {
    return state.users;
}

/**
 * Returns images store.
 *
 * @param state
 * @returns {RegExp|*|string|Object}
 */
export function getImages(state) {
    return state.media.images;
}

/**
 * Returns a Image instance.
 *
 * @param state
 * @returns {*|null}
 */
export function getFeaturedImage(state) {
    if(state.media.featuredImage) {
        return state.media.images.filter((image) => {
            return image.name == state.media.featuredImage;
        })[0];
    }

    return undefined;
}

/**
 * Returns a DialogPolyFill instance.
 *
 * @param state
 * @returns {*|string}
 */
export function getDialogPolyFill(state) {
    return state.defaults.dialogPolyfill;
}