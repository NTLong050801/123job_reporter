@extends('company::layouts.master')
@section('title', "Sửa menu")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('menu::edit') }}
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-body">
                    @include('company::pages.menu.form', ['action'=> route('get.menu.update', $item->id)])
                </div>
            </div>
        </div>
    </div>
@stop
