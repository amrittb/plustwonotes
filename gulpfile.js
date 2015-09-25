var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
	mdl : './bower_components/material-design-lite',
	jquery: './bower_components/jquery'
};

elixir(function(mix) {
    mix.sass('app.scss',null,{
    	includePaths: paths.mdl + '/src'
    });

    mix.scripts([
    	'jquery/dist/jquery.js',
        'material-design-lite/material.js'
    ],'./resources/assets/js/framework.js','./bower_components')
        .scripts([
            'framework.js','app.js'
    ],'./public/js/app.js');

    mix.version(['css/app.css','js/app.js']);
});
