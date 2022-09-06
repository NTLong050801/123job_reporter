@extends('company::layouts.master')
@section('title', 'Sắp xếp module')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/m_company/css/module.css') }}">
@stop
@section('content')
    {{ Breadcrumbs::render('module::sort') }}
    <div class="row">
        <div class="col-md-3 col-lg-4">
            <ul class="menu-list">
                @foreach ($menus as $key => $menu)
                    <li {{ $key == 0 ? 'class=select' : '' }} id={{ $menu->id }}>
                        {{ $menu->menu_name }}
                    </li>
                @endforeach
            </ul>
            <span class="text-muted">( Kéo thả để sắp xếp )</span>
        </div>
        <div class="col-md-9 col-lg-8">
            <div class="box box-custome">
                <div class="sort">
                    <ul id="list1" class='mainlist'>
                        @foreach ($modules as $module)
                            <li class="li1" id="set_{{$module->id}}" data-id={{$module->id}}>
                                <div class="div1">
                                    <div class="width1 text-bold">{{ $module->title }}</div>
                                    <div class="width2"></div>
                                    <div class="width3"></div>
                                </div>
                                <ul class="sublist">
                                    @foreach ($submodules as $submodule)
                                        @if ($submodule->parent_id == $module->id)
                                            <li class="li2" id="set_{{$submodule->id}}" data-id={{$submodule->id}}>
                                                <div class="div1">
                                                    <div class="width1">{{ $submodule->title }}</div>
                                                    <div class="width2">{{ $submodule->name }}</div>
                                                    <div class="width3">{{ $submodule->uri }}</div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        var URL_AJAX_MODULE = '{{ route('get.module.sort_update') }}';
    </script>
    <script src="/vendor/m_company/js/module.js"></script>
@stop
