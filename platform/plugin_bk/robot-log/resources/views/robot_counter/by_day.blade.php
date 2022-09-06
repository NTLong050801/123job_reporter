@extends('company::layouts.master')
@section('title', "Robot Counter By Day")
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
                        @include('plugins.robot-log::robot_counter.include._inc_form_search')
                    </div>
                    <div class="box-body">
                        {!! PaginateHelper::show($items) !!}
                        <table class="table table-hover table-bordered table-scroll">
                            <thead>
                                <tr>
                                    <th>Ngày</th>
                                    <th>BOT</th>
                                    <th>Label Page</th>
                                    <th>Path page</th>
                                    <th>Total Visit</th>
                                    <th>Total time</th>
                                    <th>Avg execute time</th>
                                    <th>Max execute time</th>
                                    <th>Min execute time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->bot }}</td>
                                        <td>{{ $item->label_page }}</td>
                                        <td>{{ $item->path }}</td>
                                        <td>{{ $item->total_visit }}</td>
                                        <td>{{ $item->total_time / 1000 }} s</td>
                                        <td>{{ $item->avg_execute_time / 1000 }} s</td>
                                        <td>{{ $item->max_execute_time / 1000 }} s</td>
                                        <td>{{ $item->min_execute_time / 1000 }} s</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! PaginateHelper::paginate($items) !!}
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
