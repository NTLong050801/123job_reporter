@extends('company::layouts.master')
@section('title', "Report site reference by site")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('apply-job-overview') }}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="form-search pull-left fFilterC">
                            <form action="" method="get"
                                  class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="date_range" autocomplete="off"
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
                        <div class="row-employee data-grid-header clearfix">
                            <div class="button-groups pull-left">
                                <div class="btn-group">
                                    <a id="assign" href="{{ route('get.apply-job.overview') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Xem theo ngày
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a id="assign" href="{{ route('get.apply-job.by_month') }}" class="btn btn-default btn-sm">
                                         Xem theo tháng
                                    </a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered table-scroll">
                            <thead>
                            <tr>
                                <th width="1%" class="text-center">STT</th>
                                <th width="8%">DAY OF MONTH</th>
                                <th class="text-center" width="4%">
                                    GA-User <br>
                                    [1]
                                </th>
                                <th class="text-center" width="4%">
                                    GA-Session <br>
                                    [2]
                                </th>
                                <th class="text-center" width="4%">
                                    GA-Page view <br>
                                    [3]
                                </th>
                                <th class="text-center" width="4%">
                                    GA-Bounce rate <br>
                                    [4]
                                </th>
                                <th class="text-center" width="4%">
                                    Click open apply <br>
                                    [5]
                                </th>
                                <th class="text-center" width="4%">
                                    Apply succeed <br>
                                    [6]
                                </th>
                                <th class="text-center" width="4%">
                                    Percent Apply (%) <br>
                                    [6/1]
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $counter = 0; @endphp
                            @foreach($items['items'] as $date => $item)
                                <tr>
                                    <td class="text-center">{{ ++$counter }}</td>
                                    <td>{{ $date  }}</td>
                                    @foreach($item['visitor'] as $visitorItem)
                                        <td class="text-center">
                                            <a href="" class="text-primary"><u>{{ $visitorItem ?: 0 }}</u></a>
                                        </td>
                                    @endforeach
                                    <td class="text-center">
                                        <a href="" class="text-primary"><u>{{ $item['count'] }}</u></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="text-primary"><u>{{ $item['avg']  }}%</u></a>
                                    </td>
                                </tr>
                            @endforeach

                                <tr class="bg-gray-light">
                                    <td class="text-center"><b>#</b></td>
                                    <td class=""><b>Tổng activity</b></td>
                                    @foreach($items['userActivityCount'] as $date => $item)
                                        <td class="text-center">
                                            <span class="text-dark"><b>{{ $item ?? 0 }}</b></span>
                                        </td>
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

