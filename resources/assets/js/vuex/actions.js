import { SYNC_USERS, SYNC_USER_ROLES, SYNC_IMAGES, REMOVE_IMAGE } from "./mutation-types";

/**
 * Opens Media Attacher dialog
 *
 * @param Vuex
 */
export const openMediaAttachment = function(Vuex,selection) {
    window.app.$broadcast("MediaAttacher.Open",selection);
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

