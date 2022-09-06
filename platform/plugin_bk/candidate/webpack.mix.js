const webpack = require("../../core/webpack_base");


let build_scss = [
    {
        from: '/resources/assets/scss/pages/report_cv/index.scss',
        to: 'css/report_cv.css'
    },
    {
        from: '/resources/assets/scss/pages/report_static/index.scss',
        to: 'css/report_static.css'
    },
    {
        from: '/resources/assets/scss/pages/report_static_chart/index.scss',
        to: 'css/report_static_chart.css'
    }
];

let build_js = [
    {
        from: '/resources/assets/js/pages/report_cv.js',
        to: 'js/report_cv.js'
    },
    {
        from: '/resources/assets/js/pages/report_static.js',
        to: 'js/report_static.js'
    },
    {
        from: '/resources/assets/js/pages/report_static_chart.js',
        to: 'js/report_static_chart.js'
    }
];

webpack.pluginPath(__dirname)
    .scss(build_scss)
    .js(build_js)
    .public("public/vendor/candidate/");
