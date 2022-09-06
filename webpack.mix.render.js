let mix = require(__dirname + '/node_modules/laravel-mix/src/index');
let webpack = require('webpack');

//copy
let copyDirectory = {
    'resources/assets/fonts': 'public/fonts',
    'resources/assets/plugins/bootstrap': 'public/libs/bootstrap',
    'resources/assets/plugins/ckeditor': 'public/libs/ckeditor',
    'resources/assets/plugins/nestable': 'public/libs/nestable',
    'resources/assets/plugins/cropper': 'public/libs/cropper',
    'resources/assets/plugins/sortable': 'public/libs/sortable',
    'resources/assets/plugins/daterangepicker': 'public/libs/daterangepicker',
    'resources/assets/plugins/select2': 'public/libs/select2',
    'resources/assets/plugins/jquery_ui.min.js': 'public/libs/jquery_ui.min.js',
    'resources/assets/plugins/jquery-3.5.1.min.js': 'public/libs/jquery-3.5.1.min.js',
    'resources/assets/js/sticky-nav.js': 'public/libs/sticky-nav.js'
};

for (let property in copyDirectory) {
    console.log('-- Render ' +property + ' >>>>>> ' + copyDirectory[property]);
    mix.copyDirectory(property, copyDirectory[property]);
}

new webpack.LoaderOptionsPlugin({
    test: /\.s[ac]ss$/,
    options: {
        includePaths: [
            path.resolve(__dirname, './public/')
        ]
    }
});

if (mix.inProduction()) {
    mix.version();
}
