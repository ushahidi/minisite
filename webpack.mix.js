const mix = require("laravel-mix");
require('laravel-mix-svg-vue');

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
mix.options({
    imgLoaderOptions: {
      enabled: false
    },
    processCssUrls: false
});
mix.js("resources/js/withvue.js", "public/js").svgVue();
mix.js("resources/js/withleaflet.js", "public/js");
mix.js("resources/js/app.js", "public/js");
mix.js("resources/js/3rdparty/856c74694a.js", "public/js");
// mix.copy('resources/img/tiptap', 'public/img/tiptap');
mix.copy('resources/img/**', 'public/img/');

// mix.copy('resources/css/MaterialIcons.css', 'public/css/MaterialIcons.css');
// mix.copy('resources/css/Roboto300-400-500.css', 'public/css/Roboto300-400-500.css');

mix.sass(
    "resources/sass/app.scss",
    "public/css",
    {
        includePaths: ["node_modules"]
    }
);

if (mix.inProduction()) {
    mix.version();
}
// https://browsersync.io/docs/options
mix.browserSync({
    files: [
        // "resources/**/*",
        "resources/sass/*.scss",
        "resources/js/**/*.js",
        "resources/views/**/*.php"
    ],
    proxy: "localhost:3000"
});

