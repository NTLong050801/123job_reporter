const webpack = require ("../../core/webpack_base");

let build_scss = [
    {
        from: '/resources/assets/scss/employee/create.scss',
        to: 'css/employee_create.css'
    }
];

let build_js = [
    {
        from: '/resources/assets/js/employee/create.js',
        to: 'js/employee_create.js'
    }
];

webpack.pluginPath(__dirname)
    .scss(build_scss)
    .js(build_js)
    .public("public/vendor/employee/");
