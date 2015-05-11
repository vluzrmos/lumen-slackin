var gulp = require("gulp");
var shell = require("gulp-shell");
var elixir = require('laravel-elixir');

/**
 * Task to compile resource/lang into public/js/messages.js
 */
elixir.extend("langjs", function(path) {
    gulp.task("langjs", function() {
        gulp.src("").pipe(shell("php artisan lang:js " + (path || "public/js/messages.js")));
    });

    return this.queueTask("langjs");
});

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

    mix.langjs();

    mix.scripts([
        'jquery.js',
        'bootstrap.js',
        'messages.js',
        'socket.io.js'
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


