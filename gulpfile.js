var gulp = require("gulp");
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

elixir(function(mix) {
    mix.scripts([
        'jquery.js',
        'bootstrap.js'
    ], 'public/js/all.js', 'public/js');

    mix.scripts(['app.js'], 'public/js/app.min.js', 'public/js');

    mix.styles([
        'bootstrap.css',
        'bootstrap-theme.css',
        'app.css'
    ], 'public/css/all.css', 'public/css');

    mix.version([
        'public/css/all.css',
        'public/js/all.js',
        'public/js/app.min.js'
    ]);

    mix.copy('public/fonts', 'public/build/fonts');
});


