@extends('admin::layouts.master')
@section('title', "Admin thuộc tính")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="form-filter pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="name" placeholder="Tìm tên" value="{{ form_query('name', $query) }}">
                            <div class="form-group">
                                <select name="type" class="form-control" id="">
                                    <option value="">-- Kiểu thuộc tính --</option>
                                    @foreach($types as $key=> $type)
                                        <option {{ query_selected('type', $key) }} value="{{ $key }}">{{ $type['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('get.adm_attr.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
                    </div>
                </div>
                <div class="box-body">
                    {!! PaginateHelper::show($items) !!}
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="10%">Loại thuộc tính</th>
                            <th>Tên thuộc tính</th>
                            <th>Slug</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center" width="10%">Người tạo</th>
                            <th class="text-center" width="10%">Ngày tạo</th>
                            <th class="text-center" width="10%">Ngày cập nhật</th>
                            <th class="text-center" width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    {{ $item->type_text }}
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td align="center">
                                    {!! \Workable\Attribute\Enum\AttributeStatusEnum::status($item->status) !!}
                                </td>
                                <td align="center">
                                    {{ ucfirst($item->admin->name) ?? 'N\A' }}
                                </td>
                                <td align="center">
                                    {{ ucfirst($item->created_at) ?? 'N\A' }}
                                </td>
                                <td align="center">
                                    {{ ucfirst($item->updated_at) ?? 'N\A' }}
                                </td>
                                <td align="center">
                                    <a href="{{ route('get.adm_attr.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Sửa</a>
                                    @if ($item->status == 0)
                                        <a href="{{ route('get.adm_attr.status', $item->id) }}?status=-1" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Ẩn</a>
                                    @else
                                        <a href="{{ route('get.adm_attr.status', $item->id) }}?status=0" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Hiện</a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="table-footer">
                        {!! PaginateHelper::paginate($items, $query) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
