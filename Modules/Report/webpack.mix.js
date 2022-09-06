const mix = require('laravel-mix'),
    pathBundle = 'public/vendor/m_report/';

mix.setPublicPath(pathBundle);

let build_scss = [
    {
        from : '/Resources/assets/scss/report.scss',
        to : 'css/report.css'
    }
];
let build_js = [
    {
        from: '/Resources/assets/js/report/seo_content.js',
        to: 'js/seo_content.js'
    },
    {
        from: '/Resources/assets/js/report/upload_public.js',
        to: 'js/upload_public.js'
    },
    {
        from: '/Resources/assets/js/report/reference.js',
        to: 'js/reference.js'
    },
    {
        from: '/Resources/assets/js/report/robot.js',
        to: 'js/robot.js'
    }
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
