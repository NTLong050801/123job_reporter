@extends('company::layouts.master')
@section('title', "Report site reference by site")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('reference-job-day') }}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="form-search pull-left fFilterC">
                            <form action="" method="get"
                                  class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           name="month_range" autocomplete="off"
                                           placeholder="Chọn thời gian" value="{{ form_query('date_range', $query) }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
                                    </button>
                                    <a href="" class="btn btn-default">Làm
                                        mới</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box-body">
                        @php
                            $count = 0;
                            $note  = '';
                        @endphp

                        <div class="row-employee data-grid-header clearfix">
                            <div class="button-groups pull-left">
                                <div class="btn-group">
                                    <a id="assign" href="{{ route('get.reference-site.overview') }}" class="btn btn-default btn-sm">
                                         Xem theo ngày
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a id="assign" href="{{ route('get.reference-site.month') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Xem theo tháng
                                    </a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-bordered table-scroll">
                            <thead>
                            <tr>
                                <th width="1%" class="text-center">STT</th>
                                <th width="10%">DAY OF MONTH</th>
                                @foreach($items['headingInfo'] as $heading)
                                    <th width="4%" class="text-center">
                                        {{ $heading }}
                                    </th>
                                @endforeach
                                <th width="4%" class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($items['items'])
                                @foreach($items['items'] as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ ++ $count}}</td>
                                        <td>{{ $key }}</td>
                                        @foreach($item['visitor'] as $providerValue)
                                            <td class="text-center">
                                                <a href="" class="text-primary font-weight-bold">
                                                    <u>{{ $providerValue }}</u>
                                                </a>
                                            </td>
                                        @endforeach

                                        @foreach($item['provider'] as $providerPercent)
                                            <td class="text-center">
                                                <a href="" class="text-primary font-weight-bold">
                                                    <u>{{ $providerPercent['count'] }}</u> <small class="text-success">(~ {{ $providerPercent['percent'] }}%)</small>
                                                </a>
                                            </td>
                                        @endforeach
                                        <td align="center"><b>{{ $item['total'] }}</b></td>
                                    </tr>
                                @endforeach
                                @php $proCountTotal = 0; @endphp

                                <tr class="bg-gray-light">
                                    <td align="center"><b>#</b></td>
                                    <td><b>TỔNG</b></td>
                                    @foreach($items['footerArr'] as $footerItem)
                                        @if (is_array($footerItem))
                                            <td class="text-center">
                                                <b>{{ $footerItem['count'] }}</b>
                                                <small class="text-success">(~ {{ $footerItem['percent'] }}%)</small>
                                            </td>
                                        @else
                                            <td class="text-center"><b>{{ $footerItem }}</b></td>
                                        @endif
                                    @endforeach
                                </tr>

                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Không tồn tại bản ghi</td>
                                </tr>
                            @endif
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

