@extends('company::layouts.master')
@section('title', "Thêm phòng ban")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('department::add') }}
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.organization::pages.department.form', ['action'=> route('get.department.store')])
                </div>
            </div>
        </div>
    </div>
@stop

