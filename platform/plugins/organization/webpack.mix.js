const mix = require('laravel-mix'),
    pathBundle = 'public/vendor/organization/';
// require('laravel-mix-merge-manifest');

mix.setPublicPath(pathBundle);
let build_scss = [];

let build_js = [{
    from: '/resources/assets/js/announcement.js',
    to: 'js/announcement.js'
}, ];

// Run
build_scss.map((val) => {
    let from = __dirname + val.from,
        to = val.to;
    mix.sass(from, to).minify(pathBundle + to)
});
build_js.map((val) => {
    let from = __dirname + val.from,
        to = val.to;
    mix.js(from, to)
});

mix.webpackConfig({
    module: {
        rules: [

        ]
    },
});
mix.options({
    processCssUrls: false,
    terser: {
        extractComments: false,
    }
}).autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
});
if (mix.inProduction()) {
    mix.version();
}