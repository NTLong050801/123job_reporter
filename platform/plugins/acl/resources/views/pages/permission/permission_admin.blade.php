@extends('company::layouts.master')
@section('title', "Danh sách module")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.permission.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="admin_id" placeholder="-- Admin code--" class="form-control" value="{{ $query['admin_id'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i>Lọc</button>
                                <a href="{{ route('get.permission.index') }}" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="box-body">
                    <div class="admin-info">
                        <div class="admin-info__item">
                            <span class="admin-info__title">Title:</span>
                            <span class="label label-info"> {{ $permission->title }} </span>
                        </div>
                        <div class="admin-info__item">
                            <span class="admin-info__title">Name:</span>
                            <span class="label label-success"> {{ $permission->name }}</span>
                        </div>
                        <div class="admin-info__item">
                            <span class="admin-info__title">URI: </span>
                            <span class="label label-default">{{ $permission->uri }}</span>
                        </div>
                    </div>
                    <br>
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                        <tr class="text-bold">
                            <td >Name</td>
                            <td class="text-center">Email</td>
                            <td class="text-center">Phone</td>
                            <td class="text-center">Aciton</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($user_permission1 as $item)
                        <tr>
                            <td >{{$item->name}}</td>
                            <td class="text-center">{{$item->email}}</td>
                            <td class="text-center">{{$item->phone}}</td>
                            <td class="text-center">
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($user_permission2 as $item)
                        <tr>
                            <td >{{$item->name}}</td>
                            <td class="text-center">{{$item->email}}</td>
                            <td class="text-center">{{$item->phone}}</td>
                            <td class="text-center">
                                @if ($item->id!=1)
                                <a href="{{route('get.permission.admin_update', [$permission->id, $item->id] )}}"
                                    class="btn btn-sm btn-danger edit"><i class="fa fa-trash"></i> Xóa</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop

@section('script')
    {{-- <script src="{{asset('system')}}/js/permission.js"></script> --}}
@stop

