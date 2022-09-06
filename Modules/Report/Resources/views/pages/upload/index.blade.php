@extends('company::layouts.master')
@section('title', "Danh sách seo")@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/m_report/css/report.css') }}">
@stop

@section('content')
    <div class="row report-header">
        <div class="col-md-12">
            <h3 class="mt-5">Report : Upload/Public</h3>
        </div>
        <div class="" style="padding-right: 35px">
            <ul class="breadcrumb-list">
                <li>Overview</li>
                <li>Upload</li>
            </ul>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            @include('report::pages.components._inc_filter', ['action'=> route('get.upload.index')])
        </div> <!--end filter-->
        <div class="row">
            <div class="col-md-12 report-content">
                @foreach($sites as $key => $site)
                    <div class="col-md-4">
                        <div class="chart-item">
                            <div class="chart-header">
                                <div class="">
                                    <b>{{$site->site_name}} : </b>
                                    <a target="_blank" href="{{$site->site_url}}">{{$site->site_url}}</a>
                                </div>
                            </div>
                            <div id="" data-id="{{$site->id}}" class="chart">

                            </div>
                        </div>
                    </div>
                @endforeach <!-- end report content-->
            </div>
        </div>
        <div style="padding-right: 30px;padding-left: 15px" class="paginate">
            {!! PaginateHelper::paginate($sites, $query) !!}
        </div>  <!-- end paginate -->
    </div>
    <input type="hidden" class="js-day" value="{{ form_query('day', $request)}}">
@stop
@section('script')
    <script src="{{ mix('js/upload_public.js','/vendor/m_report') }}"></script>
    <script>
        var URL_SHOW_UPLOAD_PUBLIC = '{{route('get.data.upload.public')}}';
    </script>
@stop
