@extends('company::layouts.master')
@section('title', "Dashboard")
@section('content')
    <style>
        .small-box:hover {
            text-decoration: none;
            color: #000000;
        }
        a.small-box-footer:hover {
            text-decoration: underline;
        }
    </style>
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box panel panel-info">
                <div class="panel-body">
                    <div style="display: flex;justify-content: space-between" class="inner">
                        <div class="">
                            <h3>{{$total}}</h3>
                            <p>Monitor</p>
                        </div>
                        <div class="">
                            <h4>Total Monitors</h4>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <a href="{{route('get.monitor.index')}}" class="small-box-footer">
                        show "total" monitors
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box panel panel-success">
                <div class="panel-body">
                    <div style="display: flex;justify-content: space-between" class="inner">
                        <div class="">
                            <h3>{{$up_total}}</h3>
                            <p>Monitor</p>
                        </div>
                        <div class="">
                            <h4>Up Monitors</h4>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <a href="{{route('get.monitor.index',['uptime_status' => 'Up'])}}" class="small-box-footer">
                        show "up" monitors
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box panel panel-danger">
                <div class="panel-body">
                    <div style="display: flex;justify-content: space-between" class="inner">
                        <div class="">
                            <h3>{{$down_total}}</h3>
                            <p>Monitor</p>
                        </div>
                        <div class="">
                            <h4>Down Monitors</h4>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <a href="{{route('get.monitor.index',['uptime_status' => 'Down'])}}" class="panel-heading small-box-footer">
                        show "down" monitors
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box panel panel-warning">
                <div class="panel-body">
                    <div style="display: flex;justify-content: space-between" class="inner">
                        <div class="">
                            <h3>{{$pause_total}}</h3>
                            <p>Monitor</p>
                        </div>
                        <div class="">
                            <h4>Pause Monitors</h4>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <a href="{{route('get.monitor.index',['uptime_status' => 'Pause'])}}" class="panel-heading small-box-footer">
                        show "pause" monitors
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
@stop
