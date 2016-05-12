import { SYNC_USERS, SYNC_USER_ROLES } from "./mutation-types";

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
 * Syncs User Roles to users Store
 *
 * @param dispatch
 * @param user
 */
export const syncUserRoles = function({dispatch},user) {
    dispatch(SYNC_USER_ROLES,user);
};