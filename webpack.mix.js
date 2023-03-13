const mix = require("laravel-mix");

mix.webpackConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js/"),
            "~": path.resolve(__dirname, "public/"),
        },
    },
});

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
mix.autoload({
    jquery: ['$', 'window.$', 'window.jQuery', 'jQuery']
});

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/admin.js", "public/js")
    .js("resources/js/front.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .extract(['vue', 'bootstrap', 'vuex', 'axios', 'vuetify']);

mix.extract(['jquery'], 'public/js/vendor-jquery.js');

mix.scripts(
    [
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/datatables.net/js/jquery.dataTables.js',
        'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
        'node_modules/datatables.net-buttons/js/dataTables.buttons.js',
        'node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',
        'node_modules/datatables.net-responsive/js/dataTables.responsive.min.js',
        'node_modules/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
        'node_modules/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min.js',
        'node_modules/datatables.net-fixedcolumns-bs4/js/fixedColumns.bootstrap4.min.js',
        'node_modules/datatables.net-colreorder-bs4/js/colReorder.bootstrap4.min.js',
        'node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js',
        'node_modules/datatables.net-buttons/js/buttons.colVis.min.js',
        'node_modules/datatables.net-buttons/js/buttons.html5.min.js',
        'node_modules/datatables.net-buttons/js/buttons.print.min.js',
        'node_modules/datatables.net-buttons/js/buttons.flash.min.js',
        'node_modules/jszip/dist/jszip.min.js',
        'node_modules/datatables.net-scroller/js/dataTables.scroller.min.js'
    ],
    'public/js/datatables.bundle.js'
);
mix.styles(
    [
        'node_modules/datatables/media/css/jquery.dataTables.min.css',
        'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
        'node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
        'node_modules/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css',
        'node_modules/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css',
        'node_modules/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css',
        'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',
        'node_modules/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css'
    ],
    'public/css/datatables.bundle.css'
);

if (mix.inProduction()) {
    mix.version();
}
else {
    mix.sourceMaps();
}
