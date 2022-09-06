@extends('company::layouts.master')
@section('title', "Chỉnh sửa user")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/employee/css/employee_create.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('employee::edit') }}
    <div class="row">
        <div class="col-md-12">
            @include('plugins.employee::employee.form', ['action' => route('post.employee.update', $user->id)])
        </div>
    </div>
@stop
