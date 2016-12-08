import { showErrorSnackbar } from "../vuex/actions";

export default class AuthManager {

    constructor() {
        var tokenMeta = document.querySelector('meta[name="_jwt_token"]');

        if(tokenMeta) {
            this._token = tokenMeta.getAttribute('content');
        }
    }

    /**
     * Attaches Authentication Header.
     * @param request
     * @param next
     */
    attachAuthenticationHeader(request, next) {
        if (this._token) {
            this.processRequest(request,next);
        }
    }

    /**
     * Processes Request for correct authentication headers.
     *
     * @param request
     * @param next
     */
    processRequest(request,next) {
        this.addAuthenticationHeader(request);
    }

    /**
     * Adds Authentication header to the request.
     *
     * @param request
     */
    addAuthenticationHeader(request) {
        request.headers.set('Authorization','Bearer ' + this._token);
    }

    /**
     * Refreshes JWT Token from response.
     *
     * @param response
     */
    refreshTokenFromResponse(response) {
        let refreshedToken = response.headers.get("Authorization").split(" ")[1];
        this.refreshToken(refreshedToken);
    }

    /**
     * Refreshes token in auth manager.
     *
     * @param token
     */
    refreshToken(token) {
        this._token = token;
    }

    /**
     * Show authentication error.
     */
    showAuthError() {
        showErrorSnackbar(window.app,"Try logging in again");
    }
}