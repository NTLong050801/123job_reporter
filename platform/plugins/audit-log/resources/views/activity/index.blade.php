@extends('company::layouts.master')
@section('title', 'Danh sách hoạt động')
@section('content')
    @include('plugins.audit-log::activity.inc_style')
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="body">
                    {!! PaginateHelper::show($users) !!}
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="1%" class="text-center">ID</th>
                                <th width="25">Mô tả</th>
                                <th width="7%" class="text-center">Admin</th>
                                <th width="7%" class="text-center">Action</th>
                                <th width="15%">Route</th>
                                <th width="15%" class="text-center">Ip Address</th>
                                <th width="10%">Agent</th>
                                <th width="15%">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><span>{{ $user->id }}</span></td>
                                    <td>{{ $user->description . ' ' . $user->reference_id }}</td>
                                    <td class="text-center"><span
                                            class="label label-default">{{ $user->admin->name }}</span></td>
                                    <td class="text-center">
                                        {!! \Workable\AuditLog\Enum\ActivityActionEnum::status($user->action) !!}
                                    </td>
                                    <td><em>{{ $user->route }}</em></td>
                                    <td class="text-center">{{ $user->ip_address }}</td>
                                    <td>
                                      <div>{!! \Workable\AuditLog\Enum\ActivityAgentEnum::status($user->browser) !!}</div>
                                      <div>{!! \Workable\AuditLog\Enum\ActivityAgentEnum::status($user->platform) !!}</div>
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
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
