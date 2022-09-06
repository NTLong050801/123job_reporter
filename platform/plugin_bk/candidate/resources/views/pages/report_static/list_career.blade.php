@extends('company::layouts.master')
@section('title', 'Report Career')
@section('css')
    {!! css_src('/css/report_static.css', '/vendor/candidate/') !!}
@endsection
@section('content')
    <div id="table-list">
        <div class="box box-default">
            <div class="box-header">
                @include('plugins.candidate::pages.report_static.components.filter_career')
            </div>
            <div class="box-body">
                @include('plugins.candidate::pages.report_static.components.content_career')
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/knockout.js') }}"></script>
    {!! script_src('/js/report_static.js', '/vendor/candidate/') !!}
@endsection
