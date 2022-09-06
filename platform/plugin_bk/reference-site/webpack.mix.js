const webpack = require ("../../core/webpack_base");

let build_scss = [
  {
    from: '/resources/assets/scss/refer-site.scss',
    to: 'css/refer-site.css'
  }
];

let build_js = [
  {
    from: '/resources/assets/js/refer-site.js',
    to: 'js/refer-site.js'
  }
];


let webpackConfig = {
    resolve: {
        alias: {
            assets: path.resolve(__dirname, '../../../resources/assets')
        },
    },
};

webpack
    .setConfig(webpackConfig)
    .pluginPath(__dirname)
    .scss(build_scss)
    .js(build_js)

  .public("public/vendor/reference-site/");
