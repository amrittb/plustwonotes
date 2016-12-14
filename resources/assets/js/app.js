import Mdl from 'material-design-lite';

import Vue from 'vue';
import store from "./vuex/store";

require("./bootstrap");

/**
 * Root Vue Instance.
 */
window.app = new Vue({
    el : 'body',
    store
});

require("./reveal");