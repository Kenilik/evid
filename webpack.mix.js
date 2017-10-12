const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
	.js('resources/assets/js/admin.js', 'public/js')
	.js('resources/assets/js/items.js', 'public/js')
   	
   	.sass('resources/assets/sass/app.scss', 'public/css')
   	.sass('resources/assets/sass/admin.scss', 'public/css')
   	.sass('resources/assets/sass/timeline.scss', 'public/css')
   	.sass('resources/assets/sass/custom.scss', 'public/css');

mix.copy('node_modules/font-awesome/fonts', 'public/fonts')
	.copy('node_modules/selectize/dist/js/standalone/selectize.js','public/js')
	.copy('node_modules/selectize/dist/css/selectize.bootstrap3.css','public/css');