<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title') - System Reporter | 123work.net</title>
    <link rel="stylesheet" href="{{ asset('vendor/m_company/css/app_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    @yield('css')
    @stack('styles')
    <style>
        .bs-docs-sidebar .nav>li>a:focus, .bs-docs-sidebar .nav>li>a:hover {
            padding-left: 19px;
            color: #563d7c;
            text-decoration: none;
            background-color: transparent;
            border-left: 1px solid #563d7c;
        }
        .bs-docs-sidebar .nav>li>a {
            display: block;
            padding: 4px 20px;
            font-size: 13px;
            font-weight: 500;
            color: #767676;
        }
        .bs-docs-sidebar .nav .nav {
            display: none;
            padding-bottom: 10px;
        }
        .nav>li {
            position: relative;
            display: block;
        }
        .wrapper {
            padding-bottom: 100px;
        }
    </style>
</head>
<body class="sidebar-mini skin-red-light">

<div class="wrapper">
    @include('company::blocks.header')
    <main class="content">
        @include('company::blocks.messages')
        @yield('content')
    </main>
</div>

<script src="/libs/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('vendor/m_company/js/app_base.js') }}"></script>
@yield('script')
</body>
</html>
