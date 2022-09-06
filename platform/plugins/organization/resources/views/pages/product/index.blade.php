@extends('company::layouts.master')
@section('title', "Danh sách sản phẩm")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">
                <div class="box-header">
                    <div class="form-search pull-left">
                        <form action="{{ route('get.product.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" name="id" placeholder="ID"
                                       value="{{ form_query('id', $query) }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm"
                                       value="{{ form_query('name', $query) }}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="company_id" placeholder="Tên công ty"
                                       value="{{ form_query('company_id', $query) }}">
                            </div>
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
                    <div class="pull-right">
                        <a href="{{route('get.product.create')}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Thêm mới
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    {!! PaginateHelper::show($items) !!}
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" width="3%">ID</th>
                            <th width="15%">Công ty</th>
                            <th style="width: 10%;">Thanh toán</th>
                            <th style="width: 10%;">Sản phẩm cha</th>
                            <th>Sản phẩm</th>
                            <th class="text-center" width="10%">Gía sản phẩm</th>
                            <th class="text-center" width="10%">Doanh số %</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center" width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr class="">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->company->name }}</td>
                                <td>{!! \Workable\Organization\Enum\ProductTypePaymentEnum::type($item->type) !!}</td>
                                <td>{{ $item->parent->name ?? "N\A" }}</td>
                                <td>
                                    {{ $item->name }}
                                    <div>
                                        <i style="font-size:0.85em">({{ ucfirst($item->admin->name) }}
                                            - {{ $item->updated_at }})</i>
                                    </div>
                                </td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->commission }}</td>
                                <td align="center" data-toggle="tooltip" data-placement="top"
                                    data-original-title="{{ $item->updated_at }}">
                                    {!! \Workable\Organization\Enum\ProductStatusEnum::status($item->status) !!}
                                </td>
                                <td class="colControls">
                                    <a href="{{ route('get.product.edit', $item->id) }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-pencil"></i> Sửa</a>
                                    <a href="{{ route('get.product.stop', $item->id) }}"
                                       onclick="return confirm('Bạn có chắc chắn muốn dừng?')"
                                       class="btn btn-danger btn-sm"><i class="fa fa-stop"></i> Dừng</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! PaginateHelper::paginate($items, $query) !!}
            </div>
        </div>
    </div>
@endsection
