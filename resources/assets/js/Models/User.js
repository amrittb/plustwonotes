export default class User{

    /**
     * Creates a User instance.
     *
     * @param username
     * @param roles
     */
    constructor(username = '',roles = []) {
        this.username = username;
        this.roles = roles;
    }

    /**
     * Sets a username for the user.
     *
     * @param username
     */
    setUsername(username) {
        this.username = username;
    }

    /**
     * Sets Roles for the user.
     *
     * @param roles
     */
    setRoles(roles) {
        this.roles = roles;
    }

    /**
     * Checks if the selected user has a certain role.
     *
     * @param role
     * @returns {boolean}
     */
    hasRole(role) {
        var id = parseInt((typeof role == "object")?role.id:role);

        return (this.roles.indexOf(id) != -1);
    }
}