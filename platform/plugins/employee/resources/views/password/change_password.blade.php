@extends('company::layouts.master')
@section('title', "Cập nhật mật khẩu")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/employee/css/employee_create.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('employee::edit') }}
    <div class="row">
        <div class="col-md-6">
            @include('plugins.employee::password.form_password', ['action' => route('post.employee.update_pwd', $user->id)])
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('vendor/employee/js/employee_create.js') }}"></script>
@endsection
