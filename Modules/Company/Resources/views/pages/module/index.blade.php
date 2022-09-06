@extends('company::layouts.master')
@section('title', "Danh sách module")
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.permission.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <select name="menu_id" class="form-control" id="">
                                    <option value="">-- Chọn menu -- </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="admin_id" placeholder="-- Admin code--" class="form-control" value="{{ $query['admin_id'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i>Lọc</button>
                                <a href="{{ route('get.permission.index') }}" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box-body">
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                        <tr class="text-bold">
                            <td >Module</td>
                            <td class="text-center">Tên</td>
                            <td class="text-center">URI</td>
                            <td class="text-center">Author</td>
                            <td class="text-center">Ngày tạo</td>
                            <td class="text-center">Thao tác</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($modules as $module)
                            <tr class="text-bold">
                                <td >{{$module->title}}</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <a href="{{ route('get.module.edit', $module->id) }}"
                                       class="btn btn-sm btn-primary edit"><i class="fa fa-pencil"></i> Sửa</a>
                                </td>
                            </tr>
                            @foreach ($submodules as $submodule)
                                @if ($submodule->parent_id==$module->id)
                                    <tr>
                                        <td style="padding-left: 40px;">{{$submodule->title}}</td>
                                        <td class="text-center">{{$submodule->name}}</td>
                                        <td class="text-center">{{$submodule->uri}}</td>
                                        <td class="text-center">{{$submodule->admin->name ?? 'N/A'}}</td>
                                        <td class="text-center">{{$submodule->created_at}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('get.module.edit', $submodule->id) }}"
                                               class="btn btn-sm btn-primary edit"><i class="fa fa-pencil"></i> Sửa</a>
                                        </td>
                                    </tr>
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

