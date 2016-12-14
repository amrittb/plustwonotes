var elixir = require('laravel-elixir');

require('laravel-elixir-vue');

var paths = {
	mdl : './node_modules/material-design-lite',
    dialogPolyfill : './node_modules/dialog-polyfill',
    mediumEditor: './node_modules/medium-editor/src/sass'
};

elixir(function(mix) {
    mixCss(mix);
    mixScripts(mix);
    mix.version(['css/app.css','js/preload-app.js','js/app.js','js/post-editor.js']);
});

/**
 * Mixes scripts and vue components.
 *
 * @param mix
 */
function mixScripts(mix){
    mix.webpack('preload-app.js');
    mix.webpack('app.js');
    mix.webpack('post-editor.js');
}

/**
 * Mixes sass components.
 * @param mix
 */
function mixCss(mix){
    mix.sass('app.scss',null,null,{
        includePaths: [].concat(paths.mdl + '/src')
                        .concat(paths.dialogPolyfill)
                        .concat(paths.mediumEditor)
    });
}