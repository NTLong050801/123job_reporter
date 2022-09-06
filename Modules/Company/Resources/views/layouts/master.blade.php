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
        .box {
            border-top: none !important;
        }
        .widget {
            border-width: 1px;
            border-style: solid;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-color: #d3d3d3;

        }
        .widget {
            border-color: #ddd;
            min-height: 100px;
            background: #fff;
        }
    </style>
</head>
<body class="sidebar-mini skin-red-light">
<div class="wrapper">
    @include('company::blocks.header')

    <aside class="main-sidebar">
        @include('company::blocks.sidebar')
    </aside>

    <div class="content-wrapper">
        <section class="content">
            @include('company::blocks.messages')
            @yield('content')
        </section>
    </div>

</div>
@yield('modal')
<script src="{{ asset("libs/jquery-3.5.1.min.js") }}" integrity=""
        crossorigin="anonymous"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('vendor/m_company/js/app_base.js') }}"></script>
{!! script_src('libs/sticky-nav.js') !!}
@yield('script')
</body>
</html>
