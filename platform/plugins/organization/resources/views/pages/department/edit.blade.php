@extends('company::layouts.master')
@section('title', "Sửa phòng ban")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    {{ Breadcrumbs::render('department::edit') }}
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.organization::pages.department.form', ['action'=> route('get.department.update', $item->id)])
                </div>
            </div>
        </div>
    </div>
@stop

