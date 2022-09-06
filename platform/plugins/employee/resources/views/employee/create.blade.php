@extends('company::layouts.master')
@section('title', "Thêm mới nhân sự")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/employee/css/employee_create.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('employee::add') }}
    <div class="row">
        <div class="col-md-12">
            @include('plugins.employee::employee.form', ['action'=> route('post.employee.store')])
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('vendor/employee/js/employee_create.js') }}"></script>
@endsection

