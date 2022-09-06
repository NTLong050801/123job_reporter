const mix = require('laravel-mix'),
    pathBundle = 'public/vendor/acl/';
// require('laravel-mix-merge-manifest');

mix.setPublicPath(pathBundle);
let build_scss = [
    {
        from: '/resources/assets/scss/role.scss',
        to: 'css/role.css'
    },
    {
        from: '/resources/assets/scss/permission.scss',
        to: 'css/permission.css'
    }
];

let build_js = [
    {
        from: '/resources/assets/js/role.js',
        to: 'js/role.js'
    },
    {
        from: '/resources/assets/js/permission_admin.js',
        to: 'js/permission_admin.js'
    },
    {
        from: '/resources/assets/js/permission_role.js',
        to: 'js/permission_role.js'
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
    module: {
        rules: [

        ]
    },
    resolve: {
        alias: {
          Http: path.resolve(__dirname, '../../../Modules/Company/Resources/assets/js/helpers'),
          Notify: path.resolve(__dirname, '../../../resources/assets/js')
        },
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