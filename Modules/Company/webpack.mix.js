let mix = require('laravel-mix'),
    pathBundle = 'public/vendor/m_company/';

mix.setPublicPath(pathBundle);
let build_scss = [
    {
        from: '/Resources/assets/scss/pages/module.scss',
        to: 'css/module.css'
    },
    {
        from: '/Resources/assets/scss/app.scss',
        to: 'css/app_base.css'
    },
];

let build_js = [
    {
        from: '/Resources/assets/js/pages/module.js',
        to: 'js/module.js'
    },
    {
        from: '/Resources/assets/js/app.js',
        to: 'js/app_base.js'
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
