@extends('company::layouts.master')
@section('title', "Danh sách công ty")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.company.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Tên công ty"
                                       value="{{ form_query('name', $query) }}">
                            </div>
                            <div class="form-group">
                                <select name="status" class="form-control" id="">
                                    <option value="">-- Trạng thái --</option>
                                    @foreach($status as $key=> $statusItem)
                                        <option {{ query_selected('status', $key) }} value="{{ $key }}">{{ $statusItem['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
                                </button>
                                <a href="{{ route('get.company.index') }}" class="btn btn-default">Làm mới</a>
                            </div>
                        </form>
                    </div>
                    <div class="actions pull-right">
                        <a href="{{ route('get.company.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="box-body">
                    {!! PaginateHelper::show($items) !!}
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Công ty mẹ</th>
                            <th>Tên</th>
                            <th width="8%" class="text-center">Nhân viên</th>
                            <th width="8%" class="text-center">Phòng ban</th>
                            <th class="text-center">Địa chỉ</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Người tạo</th>
                            <th class="text-center">Thời gian</th>
                            <th width="13%" class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($items)
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->companyParent->name ?? 'Owner' }}</td>
                                <td>{{ $item->name }}</td>
                                <td align="center">
                                    <a href=""><span class="label label-info">{{ $item->member }}</span></a>
                                </td>
                                <td align="center">
                                    <a href=""><span class="label label-success">{{ $item->show_room }}</span></a>
                                </td>
                                <td align="center">{{ $item->address }}</td>
                                <td align="center">
                                    {!! \Workable\Organization\Enum\CompanyStatusEnum::status($item->status) !!}
                                </td>
                                <td>{{ $item->admin->name }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td align="center">
                                    <a href="{{ route('get.company.edit', $item->id) }}"
                                       class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                                    <a href="{{ route('get.company.delete', $item->id) }}"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                       class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Xoá</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                {!! PaginateHelper::paginate($items, $query) !!}
            </div>
        </div>
    </div>
@stop
@section('script')

@stop
