<template>
    <ul>
        <li v-for="role in roles" v-if="user.hasRole(role)">
            {{ role.name }}
        </li>
    </ul>
    <a href="#" v-if="isEditable" @click.prevent="openRoleEditor(username)">
        <i class="material-icons">edit</i> Edit User Role
    </a>
</template>

<script>
    import User from "../Models/User";
    import { getRoles } from "../vuex/getters";
    import { openRoleEditor, syncUsers } from "../vuex/actions";

    export default {
        props: {

            /**
             * Username of the user.
             *
             * @type {String}
             */
            username: {
                type: String,
                required: true
            },

            /**
             * Roles of the user.
             *
             * @type {Array}
             */
            userRoles: {
                type: Array,
                required: true
            },

            /**
             * Boolean to determine if the user is editable.
             *
             * @type {Boolean}
             */
            isEditable: {
                type: Boolean,
                default: false,
                required: false
            }
        },
        data() {
            return {
                user: {}
            }
        },
        created() {
            this.user = new User(this.username,this.userRoles);
            this.syncUsers(this.user);
        },
        vuex: {
            getters: {
                roles: getRoles
            },
            actions: {
                openRoleEditor,
                syncUsers
            }
        }
    }
</script>