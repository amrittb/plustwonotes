import { showErrorSnackbar } from "../vuex/actions";

export default class AuthManager {

    /**
     * Creates AuthManager Object.
     */
    constructor() {
        document.addEventListener("DOMContentLoaded", (e) => {
            var tokenMeta = document.querySelector('meta[name="_jwt_token"]');

            if(tokenMeta) {
                this._token = tokenMeta.getAttribute('content');
            }
        });
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
     * Show authentication error.
     */
    showAuthError() {
        showErrorSnackbar(window.app,"Try logging in again");
    }
}