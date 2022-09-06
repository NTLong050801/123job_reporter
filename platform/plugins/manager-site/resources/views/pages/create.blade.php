@extends('company::layouts.master')
@section('title', "Thêm site")
@section('content')
    <div style="padding-left: 0" class="content-header">
        <h1>Thêm mới Site</h1>
        {{ Breadcrumbs::render('site::add') }}
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom: 10px">
                Những ô có dấu sao (<b style="color:Red">*</b>) là bắt buộc phải nhập.
            </div>
            @include('plugins.manager-site::pages.form', ['action' => route('post.manager-site.store')])
        </div>
    </div>
@stop
