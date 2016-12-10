import Mdl from 'material-design-lite';
import ScrollReveal from 'scrollreveal';

import Vue from 'vue';
import store from "./vuex/store";

window.scrollReveal = new ScrollReveal({
    duration: 750,
    container: '.mdl-layout__content'
});

require("./bootstrap");

/**
 * Root Vue Instance.
 */
window.app = new Vue({
    el : 'body',
    store
});

require("./reveal");