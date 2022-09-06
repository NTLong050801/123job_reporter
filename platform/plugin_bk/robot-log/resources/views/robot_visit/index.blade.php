@extends('company::layouts.master')
@section('title', "Robot Visit List")
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
                        @include('plugins.robot-log::robot_visit.include._inc_form_search')
                    </div>
                    <div class="box-body">
                        {!! PaginateHelper::show($items) !!}
                        <table class="table table-hover table-bordered table-scroll">
                            <thead>
                            <tr>
                                <th>BOT</th>
                                <th>Url visit</th>
                                <th>Execute time</th>
                                <th>Visited at</th>
                                <th>Path page</th>
                                <th>Label Page</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td><b>{{ $item->bot }}</b></td>
                                    <td>{{ $item->url_visit }}</td>
                                    <td>{{ $item->execute_time / 1000 }} s</td>
                                    <td>{{ $item->visited_at }}</td>
                                    <td>{{ $item->path }}</td>
                                    <td>{{ $item->label_page }}</td>
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
