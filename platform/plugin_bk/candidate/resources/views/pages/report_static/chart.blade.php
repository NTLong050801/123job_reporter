@extends('company::layouts.master')
@section('title', 'Report Static Chart')
@section('css')
    {!! css_src('/css/report_static_chart.css', '/vendor/candidate/') !!}
    <style>
        .content-wrapper {
            background-color: #ecf0f5;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-left js-col-left" style="padding-right: 0">
            <div class="">
                <div class="panel-body" style="padding: 0 0 15px 0">
                    <div class="js-nav-tab">
                        <ul class="nav nav-tabs js-nav">
                            <li class="active" style="width: 100%;">
                                <a href="#report-level">
                                    Cấp bậc
                                </a>
                            </li>
                            <li class="" style="width: 100%;">
                                <a href="#report-education">
                                    Trình độ học vấn
                                </a>
                            </li>
                            <li class="" style="width: 100%;">
                                <a href="#report-career">
                                    Nhóm nghề (tính lũy kế)
                                </a>
                            </li>
                            <li class="" style="width: 100%;">
                                <a href="#">
                                    Địa điểm
                                </a>
                            </li>
                            <li class="" style="width: 100%;">
                                <a href="#">
                                    Mức lương
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-right">
            @include('plugins.candidate::pages.report_static.components.filter_chart')
            @include('plugins.candidate::pages.report_static.components.chart_level')
            @include('plugins.candidate::pages.report_static.components.chart_education')
            @include('plugins.candidate::pages.report_static.components.chart_career')
        </div>
    </div>
@endsection
@section('script')
    <script>
        var URL_REPORT_CAREER = '{{ route('get.report_static.chart_career') }}'
        var URL_REPORT_RANK = '{{ route('get.report_static.chart_rank') }}'
        var URL_REPORT_DEGREE = '{{ route('get.report_static.chart_degree') }}'
    </script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/knockout.js') }}"></script>
    {!! script_src('/js/report_static_chart.js', '/vendor/candidate/') !!}
@endsection
