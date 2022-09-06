@extends('company::layouts.master')
@section('title', "Danh sách vai trò")
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.role.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Tên role" value="{{ form_query('name', $query) }}">
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<input type="text" class="form-control" name="company_id" placeholder="Tên công ty" value="{{ form_query('company_id', $query) }}">--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a href="{{route('get.role.create')}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Thêm mới
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    {!! PaginateHelper::show($items) !!}
                    <table class="table table-hover table-bordered table-scroll">
                        <thead>
                        <tr>
                            <th class="text-center" width="3%">ID</th>
                            {{--<th>Công ty</th>--}}
                            <th style="width: 20%;">Vai trò</th>
                            <th style="width: 10%;">Khóa</th>
                            <th style="width: 10%;">Mô tả</th>
                            <th class="text-center">Member</th>
                            <th class="text-center" width="10%">Permission</th>
                            <th class="text-center" width="10%">Ngày tạo</th>
                            <th class="text-center" width="8%">Admin tạo</th>
                            <th class="text-center" width="7%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                {{--<td>--}}
                                    {{--<a href="" target="_blank">--}}
                                        {{--<span class="label label-primary">{{ $item->company->name ?? 'Owner' }}</span>--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description ?? 'N\A' }}</td>
                                <td class="text-center">
                                    <a href="{{route('get.role.admin', $item->id)}}" ><span
                                                class="label label-info">{{ $item->number_user }}</span></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('get.role.permission',$item->id)}}"><span
                                                class="label label-info">{{ $item->permissions->count() }}</span></a>
                                </td>
                                <td class="text-center">
                                    {{ $item->created_at }}
                                </td>
                                <td class="text-center">
                                    {{ $item->admin->name ?? 'N\A' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('get.role.edit', $item->id)}}"
                                       class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i> Sửa</a>
                                    {{--<a href="{{route('get.role.edit', $item->id)}}" class="btn btn-danger btn-sm">--}}
                                        {{--<i class="fa fa-trash"></i> User</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! PaginateHelper::paginate($items, $query) !!}
            </div>
        </div>
    </div>
@endsection
