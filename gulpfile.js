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
    mix
        // .phpUnit()
        //.compressHtml()

        .copy(
            'node_modules/font-awesome/fonts',
            'public/build/fonts/font-awesome'
        )
        .copy(
            'node_modules/bootstrap-sass/assets/fonts/bootstrap',
            'public/build/fonts/bootstrap'
        )
        .copy(
            'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
            'public/js/vendor/bootstrap'
        )
        .copy(
            'node_modules/select2/dist/js/select2.min.js',
            'public/js/vendor/select2'
        )
        .copy(
            'node_modules/parsleyjs/dist/parsley.min.js',
            'public/js/vendor/parsleyjs'
        )


        .sass([
            'app.scss',
        ], 'resources/assets/css/app.css')

        .styles([
            'app.css',
        ], 'public/css/app.css')

        .scripts([
            'plugins.js',
            'homepage.js',
            'addFormInput.js',
            'foodProduct.js',
            'additive.js',
            'validationApp.js',
        ], 'public/js/plugins.js')

        .version(["public/css/app.css", "public/js/plugins.js"]);
});
