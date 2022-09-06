@extends('company::layouts.master')
@section('title', "Thêm mới công ty")
{{--@section('em', "Các trường có dấu * là bắt buộc phải nhập")--}}
@section('content')
    {{ Breadcrumbs::render('company::add') }}
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.organization::pages.company.form', ['action'=> route('get.company.store')])
                </div>
            </div>
        </div>
    </div>
@stop
