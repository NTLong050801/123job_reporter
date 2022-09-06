@extends('company::layouts.master')
@section('title', 'Danh sách số lượng CV')
@section('css')
    {!! css_src('/css/report_cv.css', '/vendor/candidate/') !!}

@endsection
@section('content')
    <div id="table-list">
        <div class="box box-default">
            <div class="box-header">
                @include('plugins.candidate::pages.report_cv.components.filter_amount')
            </div>
            <div class="box-body table-responsive">
                @include('plugins.candidate::pages.report_cv.components.content_amount')
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/knockout.js') }}"></script>
    {!! script_src('/js/report_cv.js', '/vendor/candidate/') !!}
@endsection
