import { SYNC_USERS,SYNC_USER_ROLES } from "../mutation-types";

const state = {

};

const mutations = {

    /**
     * Syncs Users to the state.
     *
     * @param state
     * @param user
     */
    [ SYNC_USERS ] (state,user) {
        state[user.username] = user;
    },

    /**
     * Syncs User roles to the state.
     *
     * @param state
     * @param user
     */
    [ SYNC_USER_ROLES ] (state,user) {
        state[user.username].roles = user.roles;
    }
};

export default {
    state,
    mutations
};
