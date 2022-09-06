let mix = require('laravel-mix'),
    pathBundle = 'public/vendor/attribute/';

mix.setPublicPath(pathBundle);
let build_scss = [{
    from: '/resources/assets/scss/app.scss',
    to: 'css/app.css'
}];

let build_js = [{
    from: '/resources/assets/js/app.js',
    to: 'js/app.js'
}];

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