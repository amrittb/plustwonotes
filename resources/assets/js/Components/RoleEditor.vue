<template>
    <dialog id="role-editor-dialog" class="mdl-dialog">
        <h4 class="mdl-dialog__title text--light">Edit User Roles</h4>
        <div class="mdl-dialog__content">
            <mdl-checkbox v-for="role in roles"
                          :id="'role-id-' + role.id + '-checkbox'"
                          name="roles"
                          :value="role.id"
                          :label="role.name"
                          :checked="user.hasRole(role)"
                          :is-disabled="user.hasRole(role) && role.id == 4">
            </mdl-checkbox>
        </div>
        <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button" @click.prevent="syncRoles()" :disabled="isSyncing">
                Save
                <span class="mdl-spinner mdl-js-spinner is-active" v-show="isSyncing"></span>
            </button>
            <button type="button" class="mdl-button" @click="closeDialog()">Cancel</button>
        </div>
    </dialog>
</template>

<script>
    import User from "../Models/User";

    import { syncUserRoles, showSuccessSnackbar, showErrorSnackbar } from "../vuex/actions";
    import { getRoles, getUsers, getDialogPolyFill } from "../vuex/getters";

    export default {
        ready() {
            if( ! this.$el.showModal){
                this.dialogPolyFill.registerDialog(this.$el);
            }

            let self = this;
            this.resource = this.$resource(this.resourceUrl,{},{},{
                before(request) {
                    self.isSyncing = true;
                }
            });
        },
        props: {

            /**
             * Resource URL to sync the user roles.
             *
             * @type {String}
             */
            resourceUrl: {
                type: String,
                required: true
            },

            /**
             * CSRF Token to send to server to sync the user roles.
             *
             * @type {String}
             */
            csrfToken: {
                type: String,
                required: true
            }
        },
        data() {
            return {

                /**
                 * User instance to edit the roles.
                 */
                user: new User(),

                /**
                 * Vue Resource Object to use RESTful Service
                 *
                 * @type {Object}
                 */
                resource: {},

                /**
                 * Flag to determine if roles are being synced.
                 *
                 * @type {Boolean}
                 */
                isSyncing: false,
            }
        },
        vuex: {
            getters: {
                roles: getRoles,
                dialogPolyFill: getDialogPolyFill,
                users: getUsers
            },
            actions: {
                syncUserRoles,
                showSuccessSnackbar,
                showErrorSnackbar,
            }
        },
        methods : {

            /**
             * Opens the Modal Dialog.
             */
            openDialog() {
                this.$el.showModal();
            },

            /**
             * Closes the Modal Dialog.
             */
            closeDialog() {
                this.$el.close();
                this.$emit('RoleEditor.Close');
            },

            /**
             * Updates the Role Editor data.
             *
             * @param username
             */
            updateEditor(username) {
                this.username = username;

                this.user.username = this.username;
                this.user.roles = this.users[this.username].roles.slice();
            },

            /**
             * Updates the selected Roles.
             *
             * @param id
             */
            updateSelectedRoles(id) {
                if(this.user.hasRole(id)){
                    this.user.roles.splice(this.user.roles.indexOf(id),1);
                } else {
                    this.user.roles.push(parseInt(id));
                }
            },

            /**
             * Resets Role Editor.
             */
            resetRoleEditor() {
                this.isSyncing = false;
                this.closeDialog();
            },

            /**
             * Syncs the roles with the server.
             */
            syncRoles() {
                let self = this;

                this.resource.update({
                    users : this.user.username,
                    _token : this.csrfToken
                },{
                    roleIds: this.user.roles
                }).then((response) => {
                    this.resetRoleEditor();

                    if(response.data.message) {
                        this.syncUserRoles(this.user);

                        this.showSuccessSnackbar("User Roles Synced.");
                    } else {
                        this.showErrorSnackbar("Try syncing roles again later.");
                    }
                },(response) => {
                    this.resetRoleEditor();

                    this.showErrorSnackbar("Try syncing roles again later.");
                });
            }
        },
        events : {
            'RoleEditor.Open' : function(username) {
                this.openDialog();
                this.updateEditor(username);
            },
            'Checkbox.Clicked' : function(data) {
                this.updateSelectedRoles(data.value);
            }
        }
    }
</script>