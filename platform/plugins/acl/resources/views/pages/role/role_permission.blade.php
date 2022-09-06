@extends('company::layouts.master')
@section('title', "Danh sách module")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-custome">

                <div class="box-body">
                    <div class="admin-info">
                        <div class="admin-info__item">
                            <span class="admin-info__title">Title:</span>
                            <span class="label label-info"> {{ $role->title }} </span>
                        </div>
                        <div class="admin-info__item">
                            <span class="admin-info__title">Name:</span>
                            <span class="label label-success"> {{ $role->name }}</span>
                        </div>
                        <div class="admin-info__item">
                            <span class="admin-info__title">Description: </span>
                            <span class="label label-default">{{ $role->description }}</span>
                        </div>
                    </div>
                    <br>
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                        <tr class="text-bold">
                            <td >Title</td>
                            <td class="text-center">Name</td>
                            <td class="text-center">Uri</td>
                            <td class="text-center">Aciton</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permission as $item)
                        @if($item->parent_id == 0)
                            <tr>
                                <td >{{$item->title}}</td>
                                <td >{{$item->name}}</td>
                                <td >{{$item->uri}}</td>
                                <td class="text-center">
                                </td>
                            </tr>
                            @endif
                            @foreach ($permission as $item_child)
                                @if($item_child->parent_id == $item->id)
                                <tr>
                                    <td style="padding-left: 50px">{{$item_child->title}}</td>
                                    <td >{{$item_child->name}}</td>
                                    <td >{{$item_child->uri}}</td>
                                    <td class="text-center">
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

@section('script')
    {{-- <script src="{{asset('system')}}/js/permission.js"></script> --}}
@stop

