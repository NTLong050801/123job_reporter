@extends('company::layouts.master')
@section('title', "Danh sách menu admin")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.menu.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" name="menu_name" placeholder="Tên menu">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i>Lọc
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="actions pull-right">
                        <a href="{{ route('get.menu.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="text-center">Menu</th>
                            <th class="text-center">Slug</th>
                            <th>Sắp xếp</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Icon</th>
                            <th class="text-center">Đường dẫn</th>
                            <th width="5%" class="text-center">Menu</th>
                            <th class="text-center">Thời gian</th>
                            <th width="13%" class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->menu_name }}</td>
                                <td align="center">
                                    <a href="{{ route('get.permission.index', ['menu_id'=> $item->id]) }}"><span class="label label-info">{{ $item->menu_menu_hit }}</span></a>
                                </td>
                                <td align="center">{{ $item->menu_slug }}</td>
                                <td>{{ $item->menu_sort ?? 'N\A' }}</td>
                                <td align="center">{!! \Modules\Company\Enum\MenuStatusEnum::status($item->menu_status) !!}</td>
                                <td>{{ $item->menu_icon ?? 'N\A' }}</td>
                                <td>{{ $item->menu_link ?? 'N\A' }}</td>
                                <td align="center">{{ $item->menu_menu ?? '0' }}</td>
                                <td width="15%" align="center">
                                    {{ $item->created_at }} <br> {{ $item->updated_at }}
                                </td>
                                <td align="center">
                                    <a href="{{ route('get.menu.edit', $item->id) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                                    <a href="{{ route('get.menu.delete', $item->id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
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

@stop
