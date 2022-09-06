@extends('admin::layouts.master')
@section('title', "Chỉnh sửa thuộc tính")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    <div class="row">
        <div class="col-md-6">
            @include('plugins.attribute::backend.form', ['action' => route('get.adm_attr.update', $item->id)])
        </div>
    </div>
@stop
