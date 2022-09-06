const mix = require('laravel-mix'),
    pathBundle = 'public/vendor/m_monitor/';

mix.setPublicPath(pathBundle);

let build_scss = [];
let build_js = [
    {
        from: '/Resources/assets/js/monitor.js',
        to: 'js/monitor.js'
    },
];

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
    resolve: {
        alias: {
            resources_assets: path.resolve(__dirname + '/../../resources/assets'),
        }
    }
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
