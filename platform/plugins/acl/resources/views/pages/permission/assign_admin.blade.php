@extends('company::layouts.master')
@section('title', 'Phân quyền theo người dùng')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@section('content')
    <link rel="stylesheet" href="{{ asset('vendor/acl/css/permission.css') }}">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.permission.assign_admin') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <select name="admin_id" class="select-user form-control" id="" style="width:200px">
                                    <option value="" style="height: 40px">-- Chọn user -- </option>
                                    @foreach ($admins as $ad)
                                        <option  style="height: 40px" {{ query_selected('admin_id', $ad->id) }} value="{{ $ad->id }}">
                                            {{ $ad->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc</button>
                                <a href="{{ route('get.permission.assign_admin') }}" class="btn btn-default"><i
                                        class="fa fa-refresh"></i> Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body">
                    @if (isset($admin))
                        <div class="admin-info" style="margin-bottom: 10px">
                            <div class="admin-info__item">
                                <span class="admin-info__title">Tên</span>
                                {{ $admin->name }}
                            </div>
                            <div class="admin-info__item">
                                <span class="admin-info__title">Email</span>
                                {{ $admin->email }}
                            </div>
                            <div class="admin-info__item">
                                <span class="admin-info__title">Vai trò</span>
                                @foreach ($admin->roles as $role)
                                    <span class="label label-info">{{ $role->name }}</span>
                                @endforeach
                            </div>
                            <div class="admin-info__item">
                                <span class="admin-info__title">Trạng thái</span>
                                {!! \Workable\Employee\Enum\AdminEnum::status($admin->active) !!}
                            </div>
                            <div class="admin-info__item">
                                <span class="admin-info__title">Ngày tạo</span>
                                {{ $admin->creaded_at ?? 'N\A' }}
                            </div>
                        </div>
                        <table class="table table-hover table-bordered table-scroll">
                            <thead>
                                <tr class="text-bold text-center">
                                    <th width="80%" class="text-center">Quyền</th>
                                    <th width="20%" class="text-center">
                                        User : {{ $admin->name }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr class="module" data-id="{{ $menu->id }}"
                                        style="cursor: pointer">
                                        <td class="text-bold">{{ $menu->menu_name }}</td>
                                        <td></td>
                                    </tr>
                                    @foreach ($permissions as $permission)
                                        @if ($permission->menu_id == $menu->id && $permission->has_child)
                                            <tr data-module="{{ $menu->id }}">
                                                <td class="text-bold" style="padding-left: 50px">{{ $permission->title }}
                                                </td>
                                                {{-- @if (count($admin->roles) > 0)

                                                    {{ dd(13) }}
                                                @endif --}}
                                                @if ((count($admin->roles) > 0 )&& ($admin->roles[0]->id == 1))
                                                    <td class="text-center">
                                                        <input type="checkbox" placeholder="" disabled checked>
                                                    </td>
                                                @elseif(in_array($permission->id, $rolePermission))
                                                    <td class="text-center">
                                                        <input type="checkbox" placeholder="" disabled
                                                            {{ in_array($permission->id, $rolePermission) ? 'checked' : '' }}>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <input type="checkbox" placeholder="" style="cursor: pointer;"
                                                            class="js-permission-assign-admin-1"
                                                            data-permission="{{ $permission->id }}"
                                                            data-admin="{{ $admin->id ?? 0 }}"
                                                            data-parent="{{ $permission->parent_id }}"
                                                            {{ in_array($permission->id, $adminPermission) ? 'checked' : '' }}>
                                                    </td>
                                                @endif
                                            </tr>
                                            @foreach ($permissions as $permissionChild)
                                                @if ($permissionChild->parent_id == $permission->id)
                                                    <tr data-module="{{ $menu->id }}">
                                                        <td style="padding-left: 100px">
                                                            {{ $permissionChild->title }}
                                                        </td>
                                                        @if ((count($admin->roles) > 0 )&& ($admin->roles[0]->id == 1))
                                                            <td class="text-center">
                                                                <input type="checkbox" placeholder="" disabled checked>
                                                            </td>

                                                        @elseif(in_array($permissionChild->id, $rolePermission))
                                                            <td class="text-center">
                                                                <input type="checkbox" placeholder="" disabled
                                                                    {{ in_array($permissionChild->id, $rolePermission) ? 'checked' : '' }}>
                                                            </td>
                                                        @else
                                                            <td class="text-center">
                                                                <input type="checkbox" placeholder=""
                                                                    style="cursor: pointer;"
                                                                    class="js-permission-assign-admin"
                                                                    data-permission="{{ $permissionChild->id }}"
                                                                    data-admin="{{ $admin->id ?? 0 }}"
                                                                    data-parent="{{ $permissionChild->parent_id }}"
                                                                    {{ in_array($permissionChild->id, $adminPermission) ? 'checked' : '' }}>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        var URL_AJAX_PERMISSION_ASSIGN_ADMIN = '{{ route('ajax_post.permission.assign_admin') }}';

    </script>
    <script src="{{ asset('vendor/acl/js/permission_admin.js') }}"></script>
@stop
