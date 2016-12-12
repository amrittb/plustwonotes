import {
            SYNC_USERS,
            SYNC_USER_ROLES,
            SYNC_IMAGES,
            REMOVE_IMAGE,
            SYNC_FEATURED_IMAGE_EDITOR,
            CLEAR_FEATURED_IMAGE_IN_EDITOR
} from "./mutation-types";

/**
 * Opens Media Attacher dialog
 *
 * @param Vuex
 */
export const openMediaAttachment = function(Vuex,options) {
    window.app.$broadcast("MediaAttacher.Open",options);
};

/**
 * Broadcasts a RoleEditor.Open Event
 *
 * @param Vuex
 * @param username
 */
export const openRoleEditor = function(Vuex,username) {
    window.app.$broadcast("RoleEditor.Open",username);
};

/**
 * Broadcasts a Snackbar.ShowSuccess Event.
 *
 * @param Vuex
 * @param message
 */
export const showSuccessSnackbar = function (Vuex,message) {
    window.app.$broadcast("Snackbar.ShowSuccess",message);
};

/**
 * Broadcasts a Snackbar.ShowError Event.
 *
 * @param Vuex
 * @param message
 */
export const showErrorSnackbar = function (Vuex,message) {
    window.app.$broadcast("Snackbar.ShowError",message);
};

/**
 * Syncs Users to users Store
 *
 * @param dispatch
 * @param user
 */
export const syncUsers = function({dispatch},user) {
    dispatch(SYNC_USERS,user);
};

/**
 * Syncs images to media store.
 *
 * @param dispatch
 * @param images
 */
export const syncImages = function({dispatch},images) {
    dispatch(SYNC_IMAGES,images);
};

/**
 * Deletes an image from media store.
 * @param dispatch
 * @param image
 */
export const removeImage = function({dispatch},image) {
    dispatch(REMOVE_IMAGE,image);
};

/**
 * Syncs User Roles to users Store
 *
 * @param dispatch
 * @param user
 */
export const syncUserRoles = function({dispatch},user) {
    dispatch(SYNC_USER_ROLES,user);
};

/**
 * Syncs Featured Image editor.
 *
 * @param dispatch
 * @param imageName
 */
export const syncFeaturedImageEditor = function({dispatch}, imageName) {
    dispatch(SYNC_FEATURED_IMAGE_EDITOR, imageName);
};

/**
 * Clears Featured Image in Editor.
 *
 * @param dispatch
 */
export const clearFeaturedImageInEditor = function({dispatch}) {
    dispatch(CLEAR_FEATURED_IMAGE_IN_EDITOR);
};