@extends('company::layouts.master')
@section('title', "Danh sách công ty")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('company::edit') }}
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.organization::pages.company.form', ['action'=> route('get.company.update', $item->id)])
                </div>
            </div>
        </div>
    </div>
@stop

