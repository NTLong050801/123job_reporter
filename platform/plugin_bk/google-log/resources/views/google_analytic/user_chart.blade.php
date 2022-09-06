@extends('company::layouts.master')
@section('title', "GA User Chart")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    {{--{{ Breadcrumbs::render('google-analytic/user') }}--}}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        @include('plugins.google-log::google_analytic.include._inc_form_search')
                    </div>
                    <div class="box-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#label" data-toggle="tab">Nhóm Page</a></li>
                            <li><a href="#path" data-toggle="tab">Path page</a></li>
                            <li><a href="#compare-path" data-toggle="tab">So sánh path page</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="label">
                                <div style="display: flex; justify-content: space-between; flex-wrap: wrap">
                                    @forelse($data['data_label'] ?? [] as $label => $dataLabel)
                                        <div style="flex: 0 0 49%">
                                            <h3><b>{{ $label }}</b></h3>
                                            <div id="chart-{{ $label }}" style="border: 1px solid #dddddd; padding: 10px;">
                                                <div class="img-loading text-center">
                                                    <img src="http://pa1.narvii.com/7491/d8b2fb62d9bc8d6c042da4fd6ad5be92a8d97825r1-200-200_00.gif" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        Không có dữ liệu thống kê
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane" id="path">
                                <div style="display: flex; justify-content: space-between; flex-wrap: wrap">
                                    @forelse($data['data_path'] ?? [] as $path => $dataPath)
                                        <div style="flex: 0 0 49%">
                                            <h3><b>{{ $path }}</b></h3>
                                            <div id="chart-{{ str_replace('/', '-', $path) }}" style="border: 1px solid #dddddd; padding: 10px">
                                                <div class="img-loading text-center">
                                                    <img src="http://pa1.narvii.com/7491/d8b2fb62d9bc8d6c042da4fd6ad5be92a8d97825r1-200-200_00.gif" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        Không có dữ liệu thống kê
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane" id="compare-path">
                                <div style="display: flex; justify-content: space-between; flex-wrap: wrap">
                                    @forelse($data['data_index'] ?? [] as $index => $dataIndex)
                                        <div style="flex: 0 0 49%">
                                            <h3><b>{{ $index }}</b></h3>
                                            <div id="chart-{{ $index }}" style="border: 1px solid #dddddd; padding: 10px">
                                                <div class="img-loading text-center">
                                                    <img src="http://pa1.narvii.com/7491/d8b2fb62d9bc8d6c042da4fd6ad5be92a8d97825r1-200-200_00.gif" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        Không có dữ liệu thống kê
                                    @endforelse
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
                    text: 'GA',
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
                // yaxis: {
                //     title: {
                //         text: 'Chỉ số'
                //     },
                // },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };
        @php $dataChart = array_merge($data['data_label'] ?? [], $data['data_path'] ?? [], $data['data_index'] ?? []) @endphp
        @foreach($dataChart as $key => $itemChart)
            options.series = [
            @foreach($itemChart as $index => $indexData)
            @php
                ksort($indexData);
                $value = array_values($indexData);
                $value = json_encode($value);
                echo "{
                            name: '".$index."',
                            data: $value
                        },"
            @endphp
            @endforeach
        ];
            var $chart = document.querySelector("#chart-{{ str_replace('/', '-', $key) }}");
            var chart = new ApexCharts($chart, options);
            chart.render();
        @endforeach
        $('.img-loading').remove();
    </script>
@endsection

