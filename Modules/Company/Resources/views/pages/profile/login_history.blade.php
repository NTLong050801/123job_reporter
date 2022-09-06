@extends('company::layouts.master')
@section('title', 'Lịch sử login')
@section('content')
    {{--    @include('plugins.audit-log::activity.inc_style')--}}
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="body">
                    {!! PaginateHelper::show($users) !!}
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="1%" >#</th>
                            <th width="15%">Tài khoản đăng nhập</th>
                            <th width="10%" >Địa chỉ IP</th>
                            <th width="15%" >Thiết bị</th>
                            <th width="10%">Agent</th>
                            <th width="15%">Location</th>
                            <th width="20%" >Thời gian</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key=>$user)
                            <tr>
                                <td><span>{{ $key+$users->firstItem() }}</span></td>
                                <td>{{ $user->admin->name??'' }}
                                </td>
                                <td >{{ $user->ip }}</td>

                                <td >
                                    {{ $user->device}}
                                </td>
                                <td >
                                    <div>{!! \Workable\AuditLog\Enum\ActivityAgentEnum::status($user->browser) !!}</div>
                                    <div>{!! \Workable\AuditLog\Enum\ActivityAgentEnum::status($user->platform) !!}</div>
                                </td>
                                <td >
                                    {{ $user->country_name }}
                                </td>
                                <td >{{ $user->created_at }}</td>
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