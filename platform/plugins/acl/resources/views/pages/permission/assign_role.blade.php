@extends('company::layouts.master')
@section('title', 'Phân quyền theo nhóm người dùng')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="body">
                    <table class="table table-hover table-bordered table-responsive table-scroll">
                        <thead>
                            @php
                                $size = count($roles);
                            @endphp
                        <tr class="text-bold">
                            <td style="width: 20%">Quyền</td>
                            @foreach ($roles as $role)
                                <td style="width: calc(80%/{{$size}})">{{ $role->title }}</td>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($menus as $menu)
                            <tr class="module" data-id="{{ $menu->id }}"
                                style="cursor: pointer">
                                <td class="text-bold" >{{ $menu->menu_name }}</td>
                                @foreach ($roles as $role)
                                    <td></td>
                                @endforeach
                            </tr>
                            @foreach ($permissions as $permission)
                                @if ($permission->menu_id == $menu->id && $permission->has_child)
                                    <tr data-module="{{ $menu->id }}">
                                        <td class="text-bold" style="padding-left: 50px">{{ $permission->title }}</td>
                                        @foreach ($roles as $key => $role)
                                            @php
                                                $listPermissionId = [];
                                                foreach ($role->permissions as $item) {
                                                    $listPermissionId[] = $item->id;
                                                }
                                            @endphp
                                            <td class="text-center">
                                                <input type="checkbox" placeholder="" style="cursor: pointer;"
                                                       class="js-permission-assign-role"
                                                       data-permission="{{ $permission->id }}"
                                                       data-parent ="{{$permission->parent_id}}"
                                                       {{ $key == 0 ? 'checked disabled' : '' }}
                                                       data-role="{{ $role->id }}"
                                                    {{ in_array($permission->id, $listPermissionId) ? 'checked' : '' }}>
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach ($permissions as $permissionChild)
                                        @if ($permissionChild->parent_id == $permission->id)
                                            <tr data-module="{{ $menu->id }}">
                                                <td style="padding-left: 100px">{{ $permissionChild->title }}</td>
                                                @foreach ($roles as $key => $role)
                                                    @php
                                                        $listPermissionId = [];
                                                        foreach ($role->permissions as $item) {
                                                            $listPermissionId[] = $item->id;
                                                        }
                                                    @endphp
                                                    <td class="text-center">
                                                        <input type="checkbox" placeholder="" style="cursor: pointer;"
                                                               class="js-permission-assign-role-1"
                                                               data-parent ="{{$permissionChild->parent_id}}"
                                                               data-permission="{{ $permissionChild->id }}"
                                                               data-role="{{ $role->id }}"
                                                            {{ $key == 0 ? 'checked disabled' : '' }}
                                                            {{ in_array($permissionChild->id, $listPermissionId) ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
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
    <script>
        var URL_AJAX_PERMISSION_ASSIGN_ROLE = '{{ route('ajax_post.permission.assign_role') }}';
    </script>
     <script src="{{ asset('vendor/acl/js/permission_role.js') }}"></script>
@stop
