@extends('company::layouts.master')
@section('title', "Danh sách Monitors")
@section('content')
    <style>
        a.monitor-url:hover {
            text-decoration: underline;
            color: #0d6aad;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <section class="section-header">
                <h3 style="margin-bottom: 10px">Danh sách Monitor</h3>
            </section>
            <div style="padding-left: 0" class=" box-header">
                <div class="form-search pull-left">
                    <form action="{{route('get.monitor.index')}}" method="get" class="form-inline">
                        <div class="form-group">
                            <select class="form-control" name="uptime_check_enabled" id="">
                                <option value="">--Uptime Check--</option>
                                @foreach($status as $key => $st)
                                    <option value="{{$key}}">{{$st['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="certificate_check_enabled" id="">
                                <option value="">--Cert Check--</option>
                                @foreach($status as $key => $st)
                                    <option value="{{$key}}">{{$st['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="site_id" id="">
                                <option value="">--Site--</option>
                                @foreach($sites as $key => $site)
                                    <option value="{{$site->id}}">{{$site->site_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Lọc
                            </button>
                            <a href="{{route('get.monitor.index')}}" type="submit" class="btn btn-info"><i
                                    class="fa fa-refresh"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
                <div class="actions pull-right">
                    <a href="{{ route('get.monitor.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm
                        mới</a>
                </div>
            </div>
            <br>
            <div class="box ">
                <div class="box-body">
                    {!! PaginateHelper::show($items) !!}
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="text-center">Checker</th>
                            <th class="text-center">Uptime check</th>
                            <th class="text-center">Cert check</th>
                            <th class="text-center">Uptime status</th>
{{--                            <th class="text-center">Cert status</th>--}}
                            <th class="text-center">Last check</th>
                            <th width="13%" class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td width="20%">
                                    <p>{{$item->name}}</p>
                                    <a target="_blank" style="color: #0d6aad;" class="monitor-url" href="{{$item->url}}">{{$item->url}}</a>
                                </td>
                                <td align="center">{!!\Modules\Monitor\Enum\MonitorEnum::responseChecked($item->uptime_check_response_checker)  ?? '' !!}</td>
                                <td align="center">
                                    {!! \Modules\Monitor\Enum\MonitorEnum::status($item->uptime_check_enabled) !!}
                                </td>
                                <td align="center">{!! \Modules\Monitor\Enum\MonitorEnum::status($item->certificate_check_enabled) !!}</td>
                                <td align="center">
                                        {!! \Modules\Monitor\Enum\MonitorEnum::uptimeStatus($item->uptime_status,$item->uptime,$item->uptime_check_enabled) !!}

                                </td>
{{--                                <td align="center"> not yet checked</td>--}}
                                <td align="center">{{$item->last_check}}</td>
                                <td align="center">
                                    <a href="{{route('get.monitor.edit',['id'=>$item->id])}}"
                                       class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                                    <a onclick="return confirm('Bạn có muốn xóa monitor này ?')" href="{{route('get.monitor.destroy',['id'=>$item->id])}}" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! PaginateHelper::show($items) !!}
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')

@stop
