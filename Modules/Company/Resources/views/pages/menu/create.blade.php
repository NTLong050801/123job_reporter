@extends('company::layouts.master')
@section('title', "Thêm mới module")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('menu::add') }}
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    @include('company::pages.menu.form', ['action'=> route('get.menu.store')])
                </div>
            </div>
        </div>
    </div>
@stop
