@extends('company::layouts.master')
@section('title', 'Danh sách CV')
@section('css')
    {!! css_src('/css/report_cv.css', '/vendor/candidate/') !!}
@endsection
@section('content')
    <div id="table-list">
        <div class="box box-default">
            <div class="box-header">
                @include('plugins.candidate::pages.report_cv.components.filter_list')
            </div>
            <div class="box-body">
                @include('plugins.candidate::pages.report_cv.components.content_list')
            </div>
        </div>
    </div>
@endsection

@section('modal')
{{--    @include('plugins.candidate::components.modal.candidate_detail')--}}
@endsection

@section('script')
    <script>
        window._candidate = {
            url_detail : '{{ route('get.report_cv.detail') }}'
        }
    </script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/knockout.js') }}"></script>
    {!! script_src('/js/report_cv.js', '/vendor/candidate/') !!}
@endsection
