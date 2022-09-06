@extends('company::layouts.master')
@section('title', "Chỉnh sửa sản phẩm")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('product::edit') }}
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.organization::pages.product.form', ['action'=> route('get.product.update', $item->id)])
                </div>
            </div>
        </div>
    </div>
@endsection
