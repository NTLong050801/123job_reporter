@extends('company::layouts.master')
@section('title', 'Danh sách nhân sự nghỉ việc')
@section('content')
    <style>
        table.table td {
            vertical-align: middle !important;
            font-size: 14px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
            width: 30px;
            height: 30px;
        }

    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="box-head">
                    <div class="form-filter pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="name" placeholder="Tìm tên"
                                   value="{{ form_query('name', $query) }}">

                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="actions pull-right">
                        <a href="{{ route('get.employee.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                            Thêm mới</a>
                    </div>
                    <div style="clear: both"></div>
                    <br>
                </div>
                <div class="body">
                    {!! PaginateHelper::show($users) !!}
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="3%" class="text-center">ID</th>
                            <th width="10%">Họ và tên</th>
                            <th width="10%">Tài khoản</th>
                            <th width="15%">Vai trò</th>
                            <th width="5%">Giới tính</th>
                            <th width="10%" class="text-center">Ngày vào|Kết thúc</th>
                            <th width="20%" class="text-center">Công ty | Phòng ban</th>
                            <th width="5%" class="text-center">Trạng thái</th>
                            <th width="10%" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td style="text-align: center"><span>{{ $user->id }}</span></td>
                                <td>
                                    <a href="#">{{ $user->name }}</a>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {!! $roles[$user->id] ?? '' !!}
                                </td>
                                <td>
                                    {{ $user->gender ?? 'N\A' }}
                                </td>
                                <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                <td>{{ $user->department_id ?? 'N\A' }}</td>
                                <td style="text-align: center">
                                    <a href="{{ route('get.employee.status', $user->id) }}"
                                       title="Thay đổi trạng thái">
                                        {!! \Workable\Employee\Enum\EmployeeStatusEnum::status($user->active) !!}
                                    </a>
                                </td>
                                <td align="center">
                                    <a href="{{ route('get.employee.edit', $user->id) }}" title="Chỉnh sửa"
                                       class="btn btn-sm btn-primary edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('get.employee.edit_pwd', $user->id) }}" title="Thay đổi mật khẩu"
                                       class="btn btn-sm btn-success change-pwd"><i class="fa fa-cog"></i></a>
                                    @if(Auth::guard('admins')->user()->roles[0]->id ==1)
                                        <a href="{{ route('get.employee.fake_login', $user->id) }}" title="Fake login"
                                           class="btn btn-sm btn-warning change-pwd"><i class="fa fa-sign-in"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        {!! PaginateHelper::paginate($users) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
