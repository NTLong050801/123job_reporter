@extends('company::layouts.master')
@section('title', "Report site reference by site")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    {!! Breadcrumbs::render('subscribe-overview-month')!!}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="form-search pull-left fFilterC">
                            <form action="" method="get"
                                  class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Chọn tháng" value="">
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
                        <div class="row-employee data-grid-header clearfix">
                            <div class="button-groups pull-left">
                                <div class="btn-group">
                                    <a id="assign" href="{{ route('get.subscribe-job.overview') }}" class="btn btn-default btn-sm">
                                        Xem theo ngày
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a id="assign" href="{{ route('get.subscribe-job.overview_month') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                        Xem theo tháng
                                    </a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered table-scroll">
                            <thead>
                                <tr>
                                    <th width="1%" class="text-center">STT</th>
                                    <th width="8%">MONTH</th>
                                    @foreach($items['headingInfo'] as $item)
                                        <th class="text-center" width="4%">
                                            {!! $item !!}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            @php $count = 0; @endphp
                            @foreach($items['itemMonthArr'] as $month => $itemMonth)
                                <tr>
                                    <td class="text-center">{{ ++ $count }}</td>
                                    <td>{{ $month }}</td>
                                    @foreach($itemMonth['visitor'] as $valueVisitor)
                                        <td class="text-center">
                                            <a href="" class="text-primary"><u>{{ $valueVisitor }}</u></a>
                                        </td>
                                    @endforeach
                                    <td class="text-center">
                                        <a href="" class="text-success"><u>{{ $itemMonth['percent'] }} %</u></a>
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="bg-gray-light">
                                <td align="center"><b>#</b></td>
                                <td><b>TỔNG</b></td>
                                @foreach($items['footerArr'] as $footerItem)
                                    <td class="text-center"><b>{{ $footerItem }}</b></td>
                                @endforeach
                            </tr>

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

