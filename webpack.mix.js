const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass(
    "resources/sass/app.scss",
    "public/css",
    {
        includePaths: ["node_modules"]
    }
).version();

mix.styles(
    [
        'resources/js/3rdparty/Roboto300-400-500.css',
    ],
    "public/css/Roboto300-400-500.css"
).version();
mix.styles(
    [
        "resources/js/3rdparty/MaterialIcons.css"
    ],
    "public/css/MaterialIcons.css"
).version();
mix.js("resources/js/withvue.js", "public/js").version();
;

mix.js("resources/js/withleaflet.js", "public/js").version();
;
mix.js("resources/js/app.js", "public/js").version();
mix.js("resources/js/3rdparty/856c74694a.js", "public/js").version();

// https://browsersync.io/docs/options
mix.browserSync({
    files: [
        // "resources/**/*",
        "resources/sass/*.scss",
        "resources/js/**/*.js",
        "resources/views/**/*.php"
    ],
    proxy: "minisite.homestead.test"
});

mix.copy('resources/img', 'public/img');