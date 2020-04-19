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
);
mix.js("resources/js/withvue.js", "public/js");

mix.js("resources/js/app.js", "public/js");

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
