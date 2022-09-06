@extends('company::layouts.master')
@section('title', 'Chỉnh sửa module')
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('module::edit') }}
    <div class="row">
        <div class="col-md-12">
            @include('company::pages.module.form', ['action'=> route('get.module.update', $module->id)])
        </div>
    </div>
@endsection

