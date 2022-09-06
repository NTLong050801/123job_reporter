@extends('company::layouts.master')
@section('title', "Thêm chức danh")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('role::add') }}
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.acl::pages.role.form', ['action'=> route('get.role.store')])
                </div>
            </div>
        </div>
    </div>
@endsection
