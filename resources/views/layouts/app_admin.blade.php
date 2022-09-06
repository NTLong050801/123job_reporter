<!DOCTYPE html>
<html class="fixed" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập hệ thống</title>
     {!! css_src('css/app_base.css', 'vendor/m_company') !!}
</head>
<body class="hold-transition login-page">
    @yield('content')

     {!! script_src('js/app_base.js', 'vendor/m_company') !!}
</body>
</html>
