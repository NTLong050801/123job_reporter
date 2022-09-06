@extends('company::layouts.master')
@section('title', "Thêm mới monitor")
@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="section-header">
                <h3>Sửa monitor</h3>
            </section>
            <section class="section-body">
                <form action="{{route('get.monitor.update',['id'=> $item->id])}}" method="post">
                    @csrf
                    <div class="">
                        <ul class="nav nav-tabs">
                            <li class="js-tab active">
                                <a data-toggle="tab" href="#formBasic">
                                    <i class="fa fa-pencil"></i> Basic</a>
                            </li>
                            <li class="js-tab"><a data-toggle="tab" href="#formChecker">Checker</a></li>
                            <li class="js-tab"><a data-toggle="tab" href="#formAdvanced">Advanced</a></li>
                        </ul>
                        <div class="tab-content">
                            <div style="margin-bottom: 10px">
                                Những ô có dấu sao (<b style="color:Red">*</b>) là bắt buộc phải nhập.
                            </div>
                            <div id="formBasic" class="js-tab-block"
                                 style=" {{ $tab_active == 'basic' ? 'display:block' : 'display:none' }}">
                                @include('monitor::pages.monitor.components._inc_form_basic')
                            </div>
                            <div id="formChecker" class="js-tab-block"
                                 style=" {{ $tab_active == 'checker' ? 'display:block' : 'display:none' }}">
                                @include('monitor::pages.monitor.components._inc_form_checker')
                            </div>
                            <div id="formAdvanced" class="js-tab-block"
                                 style=" {{ $tab_active == 'advanced' ? 'display:block' : 'display:none' }}">
                                @include('monitor::pages.monitor.components._inc_form_advanced')
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button name="redirect" value="1" class="btn btn-primary"><i class="fa fa-save"></i> Lưu </button>
                        <button name="redirect" value="0" class="btn btn-success"><i class=" fa fa-check-circle"></i> Lưu & Tiếp tục</button>
                        <a class="btn btn-warning" href=""><i class="fa fa-arrow-left" ></i> Quay lại</a>
                    </div>
                </form>
            </section>
        </div>
    </div>
    @section('script')
        <script src="{{ mix('js/monitor.js','/vendor/m_monitor') }}"></script>
    @endsection
@stop
