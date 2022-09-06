let mix = require(__dirname + '/node_modules/laravel-mix/src/index');
let webpack = require('webpack');
const path = require('path');


// Plugins load packages
let plugin = process.env.platform;
if (plugin === 'plugin') {
    let namePlugin = process.env.npm_config_name;
    return require(`${__dirname}/platform/plugins/${namePlugin}/webpack.mix.js`);
}

// Section webpack ben ngoai
if (process.env.section) {
    return require(`${__dirname}/webpack.mix.${process.env.section}.js`);
}


// Modules
if (process.env.module) {
    let nameModule = process.env.npm_config_name;
    return require(`${__dirname}/Modules/${nameModule}/webpack.mix.js`);
}

// Set path output
let directory_asset = 'public/statics/main';
mix.setPublicPath(path.normalize(directory_asset));
var build_js = [

];

var build_scss = [];


build_js.map((file) => {
    mix.js(file.from, file.to);
});

build_scss.map((file) => {
    mix.sass(file.from, file.to).minify(directory_asset + '/' + file.to);
});

mix.options({
        processCssUrls: false
    })
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    });

// mix.disableNotifications();
mix.webpackConfig({
    plugins: [
        new webpack.ContextReplacementPlugin(/\.\/locale$/, 'empty-module', false, /js$/),
        new webpack.IgnorePlugin(/^codemirror$/),
    ],
    node: {
        fs: "empty"
    },
    module: {
        rules: [{
                test: /\.modernizrrc.js$/,
                use: ['modernizr-loader']
            },
            {
                test: /\.modernizrrc(\.json)?$/,
                use: ['modernizr-loader', 'json-loader']
            }
        ]
    },
    resolve: {
        alias: {
            "handlebars": "handlebars/dist/handlebars.js",
            modernizr$: path.resolve(__dirname, "resources/assets/js/.modernizrrc"),
        }
    }
});
if (mix.inProduction()) {
    mix.version();
}
// mix.browserSync('123job.abc');
new webpack.LoaderOptionsPlugin({
    test: /\.s[ac]ss$/,
    options: {
        includePaths: [
            path.resolve(__dirname, './public/')
        ]
    }
});
