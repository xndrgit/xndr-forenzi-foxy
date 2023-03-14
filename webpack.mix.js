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
    'jquery': ['$', 'window.$', 'window.jQuery', 'jQuery'],
    Popper: ['popper.js', 'default'],
});

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/admin.js", "public/js")
    .js("resources/js/front.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .extract(['vue', 'jquery', 'bootstrap', 'vuex', 'axios', 'vuetify']);

mix.styles(
    [
        'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
        'node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
        'node_modules/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css',
        'node_modules/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css',
        'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',
        'node_modules/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css',
        'node_modules/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css'
    ],
    "public/css/datatables.bundle.css"
);

if (mix.inProduction()) {
    mix.version();
}
else {
    mix.sourceMaps();
}
