<!DOCTYPE html>
<html class="fixed" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập hệ thống</title>
    <link rel="stylesheet" href="{{ mix('css/app.css', 'admin_static') }}">
</head>
<body class="hold-transition login-page">
@yield('content')
<script src="{{ mix('js/app.js', 'admin_static') }}"></script>
</body>
</html>