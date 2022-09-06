@extends('company::layouts.master')
@section('title', "Danh Sách Site")
@section('content')
    {{ Breadcrumbs::render('site') }}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <div class="form-filter pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="site_name" placeholder="Tên Site"
                                   value="{{form_query('name', $query)}}">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('get.manager-site.add') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                            Thêm mới</a>
                    </div>
                </div>
                <div class="box-body">
                    {!! PaginateHelper::show($items) !!}
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" width="3%">ID</th>
                            <th class="text-center" width="15%">Tên Site</th>
                            <th class="text-center" width="15%">URL</th>
                            <th class="text-center" width="10%">Country</th>
                            <th class="text-center" width="15%">Châu lục</th>
                            <th class="text-center" width="15%">Status</th>
                            <th class="text-center" width="10%">Ngày tạo</th>
                            <th width="1%" class="text-center" width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                <td class="text-center">
                                    {{ $item->site_name }}
                                </td>
                                <td class="text-center">
                                    <a target="_blank" href="{{ $item->site_url }}">
                                        {{ $item->site_url }}
                                    </a>
                                 </td><td class="text-center">
                                   {{$item->country}}
                                </td>

                                <td class="text-center">
                                    {!!\Workable\ManagerSite\Enum\SiteStatusEnum::continent($item->continent) !!}
                                </td>
                                <td class="text-center">
                                    {!!\Workable\ManagerSite\Enum\SiteStatusEnum::status($item->status) !!}
                                </td>
                                <td class="text-center">{{ $item->created_at }}</td>
                                <td class="text-center" style="display:flex; ">
                                    <a href="{{route('get.manager-site.edit', $item->id)}}" class="btn btn-success btn-sm" style="margin-right:6px;"><i
                                            class="fa fa-edit"></i> Sửa</a>
                                    <a  href="{{route('get.manager-site.delete', $item->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Xóa</a>
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
