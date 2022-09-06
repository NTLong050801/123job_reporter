@extends('company::layouts.master')
@section('title', "Danh sách thông báo")
@section('content')
    <style>
        .showBirthday {
            color: #8a6d3b !important;
            background-color: #fcf8e3 !important;
            border-color: #faebcc !important;
        }

        #birthDate tr td {
            padding: 5px 20px;
        }

        #birthDate tr td:first-child {
            padding-left: 0px;
        }

        #birthDate tr td:first-child {
            padding-left: 0px;
        }

        table th, table .colCheckbox, table .colControls {
            text-align: center;
        }

        i.close-show-birthday {
            position: absolute;
            right: 20px;
            top: 10px;
            cursor: pointer;
        }
    </style>
    @if ($list_birth_day->count())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning showBirthday">
                    <div class="hearder">
                        <i class="fa fa-bell icon" aria-hidden="true"></i> CHÚC MỪNG CÁC NHÂN VIÊN CÓ SINH NHẬT NGÀY {{ date_format(now(),"d/m") }}
                    </div>
                    <br><i class="close-show-birthday fa fa-times icon"></i>
                    <table id="birthDate">
                        <thead>
                        <tr>
                            <th style="padding-right: 10px">STT</th>
                            <th class="text-center">Tên nhân viên</th>
                            <th class="text-center">Phòng ban</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($list_birth_day as $key => $admin)
                                <tr>
                                    <td align="center">{{ $key + 1}}</td>
                                    <td align="center">{{ $admin->name }}</td>
                                    <td align="center">{{ $admin->department->name }}</td>
                                    <td align="center"><i class="fa fa-birthday-cake "></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div>
                    <div class="form-search pull-left">
                        <form action="{{ route('get.announcement.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Tên thông báo"
                                       value="{{ form_query('name', $query) }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="actions pull-right">
                        <a href="{{ route('get.announcement.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> Thêm mới</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br>
                <div class="">
                    {!! PaginateHelper::show($items) !!}
                    <table cellspacing="0" cellpadding="0" class="table table-hover table-bordered">
                        <thead>
                        <tr class="even">
                            <th class="text-center" width="5%">ID</th>
                            <th style="width:100px">Loại</th>
                            <th style="position: relative">Tên thông báo</th>
                            <th style="width:100px;">Người xem</th>
                            <th style="width:100px;">Trạng thái</th>
                            @if (hasRole(['admin', 'administrator']))
                                <th width="5%" class="text-center" title="Sửa"><i class="fa fa-cogs"></i></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr class="">
                                <td class="text-center">
                                    <a class="textBlack" href="{{ route('get.announcement.show', $item->id) }}">
                                        {{ $item->id }}
                                    </a>
                                </td>
                                <td class="colControls"
                                    style="width:100px">{!! \Workable\Organization\Enum\AnnouncementTypeEnum::status($item->type) !!}</td>
                                <td>
                                    @if ($item->must_read)
                                        <i style="color:red;margin-right:5px;" class="fa fa-exclamation-triangle"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           data-original-title="Thông báo quan trọng bắt buộc đọc"></i>
                                    @endif
                                    <a class="textBlack"
                                       href="{{ route('get.announcement.show', $item->id) }}">
                                        {{ ucfirst($item->name) }}
                                    </a>
                                    <div>
                                        <i style="font-size:0.85em">({{ ucfirst($item->admin->name) }}
                                            - {{ $item->created_at }})</i>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <a  class="label label-info" data-toggle="tooltip"
                                        data-placement="top" data-original-title="Số người xem">{{ $item->views }}</a>
                                </td>
                                <td align="center">
                                    {!! \Workable\Organization\Enum\AnnouncementStatusEnum::status($item->status)  !!}
                                </td>
                                @if (hasRole(['administrator', 'admin']))
                                    <td align="center">
                                        <a href="{{ route('get.announcement.edit', $item->id) }}"
                                           class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {!! PaginateHelper::paginate($items, $query) !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(function () {
            $('i.close-show-birthday').click(function () {
                $('.showBirthday').addClass('hide');
            })
        })
    </script>
@stop
