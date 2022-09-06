@extends('company::layouts.master')
@section('title', "Report site reference by site")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('reference-job-city') }}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="form-search pull-left fFilterC">
                            <form action="" method="get"
                                  class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="date_range"
                                           autocomplete="off"
                                           placeholder="Chọn thời gian"
                                           value="{{ form_query('date_range', $query) }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
                                    </button>
                                    <a href="" class="btn btn-default">Làm mới</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-hover table-bordered table-scroll">
                            <thead>
                            <tr>
                                <th width="1%" class="text-center">STT</th>
                                <th width="15%">WEBSITE</th>

                                @foreach($items['times'] as $item)
                                    <th width="4%" class="text-center">{{ $item }}</th>
                                @endforeach
                                <th width="4%" class="text-center">TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php $count = 0; @endphp
                            @foreach($items['records'] as $key => $item)
                                <tr>
                                    <td class="text-center">{{ ++ $count }}</td>
                                    <td>{{ $key }}</td>
                                    @foreach($item['count'] as $itemCount)
                                        @php $class=  $itemCount == 0 ? 'bg-danger' : 'bg-success' @endphp
                                        <td class="text-center {{ $class }}">
                                            <a href="" class="text-primary"><u>{{ $itemCount }}</u></a>
                                        </td>
                                    @endforeach
                                    <td align="center">
                                        <a href="" class="text-primary">{{ $item['total'] }}</a>
                                    </td>
                                </tr>
                            @endforeach

                            @php $timeCountTotal = 0; @endphp
                            <tr class="bg-gray-light">
                                <td align="center"><b>TỔNG</b></td>
                                <td></td>
                                @foreach($items['timeCounts'] as $value)
                                    @php $timeCountTotal += $value @endphp
                                    <td align="center"><b>{{ $value }}</b></td>
                                @endforeach
                                <td align="center"><b>{{ $timeCountTotal }}</b></td>
                            </tr>

                            </tbody>
                        </table>

                        <div class="pull-right">

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
    {!! script_src('/js/refer-site.js', '/vendor/reference-site') !!}
@endsection

