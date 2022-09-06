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
                            <span class="label label-info"> {{ $role->title }} </span>
                        </div>
                        <div class="admin-info__item">
                            <span class="admin-info__title">Name:</span>
                            <span class="label label-success"> {{ $role->name }}</span>
                        </div>
                        <div class="admin-info__item">
                            <span class="admin-info__title">Description: </span>
                            <span class="label label-default">{{ $role->description }}</span>
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
                        @foreach ($users as $item)
                        {{-- {{dd($item)}} --}}
                        <tr>
                            <td >{{$item->name}}</td>
                            <td class="text-center">{{$item->email}}</td>
                            <td class="text-center">{{$item->phone}}</td>
                            <td class="text-center">
                                <a href="{{route('get.role.admin_update', [$role->id, $item->id] )}}"
                                    class="btn btn-sm btn-danger edit"><i class="fa fa-trash"></i> Xóa</a>
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

