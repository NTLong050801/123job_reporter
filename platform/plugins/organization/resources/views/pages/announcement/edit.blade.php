@extends('company::layouts.master')
@section('title', "Chỉnh sửa thông báo")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('css')
    <script src="{{ asset("libs/ckeditor/ckeditor.js") }}"></script>
@endsection
@section('content')
    {{ Breadcrumbs::render('announcement::edit') }}
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">
                    @include('plugins.organization::pages.announcement.form', ['action'=> route('post.announcement.update', $item->id)])
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('vendor/organization/js/announcement.js') }}"></script>
@endsection

