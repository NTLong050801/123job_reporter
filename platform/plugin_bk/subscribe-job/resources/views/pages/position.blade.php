@extends('company::layouts.master')
@section('title', "Report subscribe job position")
@section("css")
    <link rel="stylesheet" href="{{ asset('vendor/reference-site/css/refer-site.min.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('subscribe-position') }}
    <div class="row">
        <div class="col-md-12">
            <div id="table-list">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="form-search pull-left fFilterC">
                            <form action="" method="get" class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="date_range" autocomplete="off"
                                           placeholder="Chọn thời gian" value="{{ form_query('date_range', $query) }}">
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
                                <th width="15%">SOURCE</th>
                                @foreach($items['headingInfo'] as $item)
                                    <th class="text-center">{{ $item }}</th>
                                @endforeach
                                <th width="4%" class="text-center">TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $count = 0; @endphp
                            @foreach($items['items'] as $position => $item)
                                <tr>
                                    <td class="text-center">{{ ++$count }}</td>
                                    <td>{{ $position }}</td>
                                    @foreach($item['count'] as $countDate)
                                        @php $class=  $countDate == 0 ? 'bg-danger' : 'bg-success' @endphp
                                        <td class="text-center {{ $class }}"><a href="" class="text-primary">{{ $countDate }}</a></td>
                                    @endforeach
                                    <td  class="text-center">{{ $item['total'] }}</td>
                                </tr>
                            @endforeach
                            @php $total = 0; @endphp
                            <tr class="bg-gray-light">
                                <td>#</td>
                                <td><b>TỔNG</b></td>
                                @foreach($items['footerArr'] as $count)
                                    @php $total += $count @endphp
                                    <td class="text-center"><b>{{ $count }}</b></td>
                                @endforeach
                                <td class="text-center"><b>{{ $total }}</b></td>
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

