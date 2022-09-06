@extends('company::layouts.master')
@section('title', "Thêm mới")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('product::add') }}
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.organization::pages.product.form', ['action'=> route('get.product.store')])
                </div>
            </div>
        </div>
    </div>
@endsection
