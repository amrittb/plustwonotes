import Vue from "vue";
import { showErrorSnackbar } from "../vuex/actions";

export default {

    /**
     * JWT Auth Token retrived from server.
     */
    _token: null,

    /**
     * Flag to determine if the token retriving process has errors.
     */
    hasTokenException: false,

    /**
     * URL to get JWT Token from server.
     */
    JWTTokenUrl: document.querySelector('meta[name="_jwt_token_url"]').getAttribute('content'),

    /**
     * Requests Token from server.
     *
     * @param onTokenObtained
     */
    requestToken(onTokenObtained) {
        Vue.http.get(this.JWTTokenUrl).then((response) => {
            this._token = response.body._token;
            onTokenObtained();
        },(response) => {
            this.hasTokenException = true;
            this.showAuthError();
        });
    },

    /**
     * Attaches Authentication Header.
     * @param request
     * @param next
     */
    attachAuthenticationHeader(request, next) {
        if(this.hasTokenException) {
            this.showAuthError();
        } else {
            if (this._token) {
                this.processRequest(request,next);
            } else {
                this.requestToken(() => {
                    this.processRequest(request,next);        
                });
            }   
        }
    },

    /**
     * Processes Request for correct authentication headers.
     *
     * @param request
     * @param next
     */
    processRequest(request,next) {
        this.addAuthenticationHeader(request);
        next();
    },

    /**
     * Adds Authentication header to the request.
     *
     * @param request
     */
    addAuthenticationHeader(request) {
        request.headers.set('Authorization','Bearer ' + this._token);
    },

    /**
     * Show authentication error.
     */
    showAuthError() {
        showErrorSnackbar(window.app,"Try logging in again");
    }
}