@extends('admin::layouts.master')
@section('title', "Thêm thuộc tính mới")
@section('content')
    <div class="row">
        <div class="col-md-6">
            @include('plugins.attribute::backend.form', ['action' => route('get.adm_attr.store')])
        </div>
    </div>
@stop
