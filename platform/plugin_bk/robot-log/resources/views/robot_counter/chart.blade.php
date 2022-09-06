@extends('company::layouts.master')
@section('title', "Robot Counter Chart")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    @php $dataChart = []; @endphp
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        @include('plugins.robot-log::robot_counter.include._inc_form_search')
                    </div>
                    <div class="box-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#overview" data-toggle="tab">Tổng quan</a></li>
                            <li><a href="#compare" data-toggle="tab">So sánh BOT truy cập</a></li>
                            @foreach($data['data_bot'] as $bot => $dataBot)
                                <li><a href="#{{ $bot }}" data-toggle="tab">{{ $bot }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            {{--Chart over view--}}
                            <div class="tab-pane active" id="overview">
                                <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                                    @foreach($data['data_over_view'] as $bot => $dataBot)
                                        <div style="flex: 0 0 49%">
                                            <h3><b>{{ $bot }}</b></h3>
                                            @php
                                                $chartName = 'chart-overview-'.$bot;
                                                $dataChart[$chartName] = $dataBot;
                                            @endphp
                                            <div id="{{ $chartName }}" style="border: 1px solid #dddddd; padding: 10px">
                                                <div class="img-loading text-center">
                                                    <img src="http://pa1.narvii.com/7491/d8b2fb62d9bc8d6c042da4fd6ad5be92a8d97825r1-200-200_00.gif" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{--Chart bot--}}
                            @foreach($data['data_bot'] as $bot => $dataBot)
                                <div class="tab-pane"
                                     id="{{ $bot }}">
                                    <h3>Report by</h3>
                                    <ul class="nav nav-tabs">
                                        @foreach($dataBot as $type => $dataType)
                                            <li class="{{ $type == array_first(array_keys($dataBot)) ? 'active' : '' }}">
                                                <a href="#{{ $bot }}-{{ $type }}" data-toggle="tab">{{ $type }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($dataBot as $type => $dataType)
                                            <div class="tab-pane {{ $type == array_first(array_keys($dataBot)) ? 'active' : '' }}"
                                                 id="{{ $bot }}-{{ $type }}">
                                                <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                                                    @foreach($dataType as $key => $dataKey)
                                                        <div style="flex: 0 0 49%">
                                                            <h3><b>{{ $key }}</b></h3>
                                                            @php
                                                                $key = str_replace('/', '-', $key);
                                                                $chartName = 'chart-'.$bot.'-'.$type.'-'.$key;
                                                                $dataChart[$chartName] = $dataKey;
                                                            @endphp
                                                            <div id="{{ $chartName }}" style="border: 1px solid #dddddd; padding: 10px">
                                                                <div class="img-loading text-center">
                                                                    <img src="http://pa1.narvii.com/7491/d8b2fb62d9bc8d6c042da4fd6ad5be92a8d97825r1-200-200_00.gif" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            {{--Chart compare bot--}}
                            <div class="tab-pane" id="compare">
                                <h3>Report by</h3>
                                <ul class="nav nav-tabs">
                                    @foreach($data['data_compare'] as $type => $dataType)
                                        <li class="{{ $type == array_first(array_keys($data['data_compare'])) ? 'active' : '' }}">
                                            <a href="#compare-{{ $type }}" data-toggle="tab">{{ $type }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($data['data_compare'] as $type => $dataType)
                                        <div class="tab-pane {{ $type == array_first(array_keys($data['data_compare'])) ? 'active' : '' }}"
                                             id="compare-{{ $type }}">
                                            <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                                                @foreach($dataType as $key => $dataKey)
                                                    <div style="flex: 0 0 49%">
                                                        <h3><b>{{ $key }}</b></h3>
                                                        @php
                                                            $key = str_replace('/', '-', $key);
                                                            $chartName = 'chart-compare-'.$bot.'-'.$type.'-'.$key;
                                                            $dataChart[$chartName] = $dataKey;
                                                        @endphp
                                                        <div id="{{ $chartName }}" style="border: 1px solid #dddddd; padding: 10px">
                                                            <div class="img-loading text-center">
                                                                <img src="http://pa1.narvii.com/7491/d8b2fb62d9bc8d6c042da4fd6ad5be92a8d97825r1-200-200_00.gif" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('libs/knockout-daterangepicker/knockout.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! script_src('/js/refer-site.js', '/vendor/reference-site') !!}
    <script>
        @php
            $js_array_dates = json_encode($data['dates']);
            echo "var dates = $js_array_dates;\n";
        @endphp
        var options = {
                chart: {
                    height: 300,
                    type: 'line',
                    toolbar: {
                        show: false
                    }
                },
                colors: ['#2196f3', '#00bcd4', '#8bc34a', '#ff5722', '#FBBC04', '#009688', '#673ab7', '#e91e63'],
                stroke: {
                    curve: 'straight',
                    width: 2
                },
                title: {
                    text: 'Robot counter',
                    align: 'left'
                },
                markers: {
                    size: 0.2
                },
                xaxis: {
                    categories: dates,
                    title: {
                        text: 'Ngày'
                    }
                },
                yaxis: {
                    decimalsInFloat: 2,
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };
            @foreach($dataChart as $chartName => $dataKey)
                options.series = [
                    @foreach($dataKey as $index => $dataIndex)
                    @php
                        ksort($dataIndex);
                        $value = array_values($dataIndex);
                        $value = json_encode($value);
                        echo "{
                                name: '".$index."',
                                data: $value
                              },"
                    @endphp
                    @endforeach
                ];
                var $chart = document.querySelector("#{{ $chartName }}");
                var chart = new ApexCharts($chart, options);
                chart.render();
            @endforeach
        $('.img-loading').remove();
    </script>
@endsection

