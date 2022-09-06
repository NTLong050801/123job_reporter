@extends('company::layouts.master')
@section('title', "Sửa Project")
@section('content')
    <div style="padding-left: 0" class="content-header">
        <h1>Sửa Site</h1>
        {{ Breadcrumbs::render('site::edit') }}
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom: 10px">
                Những ô có dấu sao (<b style="color:Red">*</b>) là bắt buộc phải nhập.
            </div>
            @include('plugins.manager-site::pages.form', ['action' => route('post.manager-site.update', $item->id)])
        </div>
    </div>
@stop
