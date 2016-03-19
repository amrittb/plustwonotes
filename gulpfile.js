var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

var paths = {
	mdl : './node_modules/material-design-lite'
};

elixir(function(mix) {
    mixCss(mix);
    mixScripts(mix);
    mix.version(['css/app.css','js/app.js']);
});

/**
 * Mixes scripts and vue components.
 *
 * @param mix
 */
function mixScripts(mix){
    mix.browserify('app.js');
}

/**
 * Mixes sass components.
 * @param mix
 */
function mixCss(mix){
    mix.sass('app.scss',null,{
        includePaths: [].concat(paths.mdl + '/src')
    });
}