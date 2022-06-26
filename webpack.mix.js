const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ])
    .postCss("resources/@fortawesome/fontawesome-free/css/all.min.css", "public/css")
    .postCss('resources/css/tailwind.css', "public/css")
    .copy("resources/@fortawesome/fontawesome-free/webfonts", "public/fonts")
    .postCss("resources/css/mainpage.css", "public/css")
    .copy("resources/js/particles.json", "public/js")
    .js("resources/js/particles.js", "public/js");
