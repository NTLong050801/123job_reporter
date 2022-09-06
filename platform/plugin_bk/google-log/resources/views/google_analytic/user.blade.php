@extends('company::layouts.master')
@section('title', "Google Analytic User")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    @php
        $logEnum = \Workable\GoogleLog\Enum\GoogleLogEnum::LOG;
    @endphp
    {{--{{ Breadcrumbs::render('google-analytic/user') }}--}}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        @include('plugins.google-log::google_analytic.include._inc_form_search')
                    </div>
                    <div class="box-body">
                        <table class="table table-hover table-bordered table-scroll">
                            <thead>
                                <tr>
                                    <th width="10%" rowspan="2">Ngày</th>
                                    <th width="10%" rowspan="2">Label page</th>
                                    <th width="20%" rowspan="2">Path page</th>
                                    <th class="text-center">Chỉ số</th>
                                </tr>
                                <tr>
                                    <th>
                                        <div style="display: flex;align-items: center">
                                            @foreach($logEnum as $key => $text)
                                                <div style="flex: 1"><b>{{ $text }}</b></div>
                                            @endforeach
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['data'] as $date => $item)
                                    <tr class="bg-primary">
                                        <td><b>{{ $date }}</b></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div style="display: flex;align-items: center">
                                                @foreach($data['total_date'][$date] ?? [] as $key =>  $itemTotal)
                                                    <div style="flex: 1">{{ $itemTotal }}</div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach($item as $label => $paths)
                                        <tr class="bg-info">
                                            <td></td>
                                            <td><b>{{ $label }}</b></td>
                                            <td></td>
                                            <td>
                                                <div style="display: flex;align-items: center">
                                                    @foreach($data['total_label'][$date][$label] ?? [] as $key =>  $itemTotal)
                                                        @if($key == 'ga_bounce_rate')
                                                        <div style="flex: 1">{{ round($itemTotal / count($paths), 2) }}</div>
                                                        @else
                                                        <div style="flex: 1">{{ $itemTotal }}</div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach($paths as $path => $logs)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $path }}</td>
                                                <td>
                                                    <div style="display: flex;align-items: center">
                                                        @foreach($logEnum as $key => $text)
                                                            <div style="flex: 1">{{ $logs[$text] ?? 0 }}</div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/knockout.js') }}"></script>
    {!! script_src('/js/refer-site.js', '/vendor/reference-site') !!}
@endsection

