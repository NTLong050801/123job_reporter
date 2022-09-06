@extends('company::layouts.master')
@section('title', "Danh sách phòng ban")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.department.index') }}" method="get" class="form-inline">
                            {{-- Công ty --}}
                            <div class="form-group">
                                <select name="company_id" class="form-control" id="company_id">
                                    <option value="">-- Công ty --</option>
                                    @foreach($companies as $company)
                                        @php
                                            $selected = query_selected('company_id', $company['id']);
                                        @endphp
                                        <option {{ $selected }} value="{{ $company->id }}">
                                            @for($i=0; $i < $company['level']; $i++)---@endfor
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Trạng thái --}}
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
                            </div>
                        </form>
                    </div>
                    <div class="actions pull-right">
                        <a href="{{ route('get.department.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> Thêm mới</a>
                    </div>
                </div>
                {{-- End form search --}}

                {{-- Begin list record --}}
                <div class="box-body">
                    <table cellspacing="0" cellpadding="0" class="table table-hover table-bordered">
                        <thead>
                        <tr class="even">
                            <th class="text-center" width="5%">Id</th>
                            <th>Công ty</th>
                            <th>Phòng ban</th>
                            <th width="5%" class="text-center">Member yes</th>
                            <th width="5%" class="text-center">Member no</th>
                            <th class="text-center">Mã code</th>
                            <th class="text-center">Người tạo</th>
                            <th class="text-center">Trạng thái</th>
                            <th width="13%" class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            @php
                                $padding_left = $item->level ?? 0;
                                $padding_left = ($padding_left == 0 ) ? 20 : $padding_left * 50;
                                $padding_left = $padding_left . 'px';
                            @endphp
                            <tr class="">
                                <td style="text-align:center">{{ $item->id }}</td>
                                <td>{{ $item->company->name }}</td>
                                <td style="padding-left: {{ $padding_left }}">
                                    <a href="https://erp.nhanh.vn/hrm/employee/index?companyId=1&amp;departmentId=353">
                                        {{ $item->name }}
                                    </a>
                                </td>
                                <td class="text-center"><a
                                            href="https://erp.nhanh.vn/hrm/employee/index?companyId=1&amp;departmentId=353">
                                        {{ $item->member_active }}</a>
                                </td>
                                <td class="text-center"><a
                                            href="https://erp.nhanh.vn/hrm/employee/index?companyId=1&amp;departmentId=353&amp;locked=1&amp;submit=L%E1%BB%8Dc">
                                        {{ $item->member_inactive }}
                                    </a>
                                </td>
                                <td class="text-center">{{ $item->code }}</td>
                                <td align="center">
                                    {{ ucfirst($item->admin->name) }} <br>
                                    <small><em>({{ $item->created_at }})</em></small>
                                </td>
                                <td align="center">
                                    {!! \Workable\Organization\Enum\DepartmentStatusEnum::status($item->status) !!}
                                </td>
                                <td align="center">
                                    <a href="{{ route('get.department.edit', $item->id) }}"
                                       class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                                    <a href="{{ route('get.department.stop', $item->id) }}"
                                       class="btn btn-danger btn-sm"><i class="fa fa-exclamation"></i> Dừng</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- End list record --}}

            </div>
        </div>
    </div>
@stop
@section('script')

@stop
