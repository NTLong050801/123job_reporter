@extends('company::layouts.master')
@section('title', 'Danh sách chức năng')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.permission.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <select name="menu_id" class="form-control" id="">
                                    <option value="">-- Chọn menu -- </option>
                                    @foreach ($menus as $menu)
                                        <option {{ query_selected('menu_id', $menu->id) }} value="{{ $menu->id }}">
                                            {{ $menu->menu_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="admin_id" placeholder="-- Admin code--" class="form-control"
                                    value="{{ $query['admin_id'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i>Lọc</button>
                                <a href="{{ route('get.permission.index') }}" class="btn btn-default"><i
                                        class="fa fa-refresh"></i> Reset</a>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="actions pull-right"> --}}
                    {{-- <a href="{{ route('get.permission.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a> --}}
                    {{-- </div> --}}
                </div>

                <div class="box-body">
                    <table class="table table-hover table-bordered table-responsive table-scroll">
                        <thead>
                            <tr class="text-bold">
                                <td width="20%">Quyền</td>
                                <td width="10%">Tên</td>
                                <td width="15%">URI</td>
                                <td width="5%" class="text-center">Number users</td>
                                <td width="5%" class="text-center">Number roles</td>
                                <td width="10%" class="text-center">Author</td>
                                <td width="10%" class="text-center">Ngày tạo</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr class="module" data-id="{{ $menu->id }}"
                                    style="cursor: pointer">
                                    <td class="text-bold">{{ $menu->menu_name }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                </tr>
                                @foreach ($permissions as $permission)
                                    @if ($permission->menu_id == $menu->id && $permission->has_child)
                                        <tr data-module="{{ $menu->id }}">
                                            <td class="text-bold" style="padding-left: 50px">{{ $permission->title }}
                                            </td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->uri }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ $permission->admin->name }}</td>
                                            <td>{{ $permission->created_at }}</td>
                                        </tr>
                                        @foreach ($permissions as $permissionChild)
                                            @if ($permissionChild->parent_id == $permission->id)
                                                <tr data-module="{{ $menu->id }}">
                                                    <td style="padding-left: 100px">
                                                        {{ $permissionChild->title }}
                                                    </td>
                                                    <td>{{ $permissionChild->name }}</td>
                                                    <td>{{ $permissionChild->uri }}</td>
                                                    <td class="text-center"><a class="label label-success"
                                                            href="{{ route('get.permission.admin', $permissionChild->id) }}">{{ $permissionChild->number_user }}</a>
                                                    </td>
                                                    <td class="text-center"><a class="label label-primary"
                                                            href="{{ route('get.permission.role', $permissionChild->id) }}">{{
                                                                $permissionChild->roles->count() + 1}} </a>
                                                    </td>
                                                    <td class="text-center">{{ $permission->admin->name }}</td>
                                                    <td>{{ $permission->created_at }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="{{ asset('vendor/acl/js/permission_admin.js') }}"></script>
@stop
