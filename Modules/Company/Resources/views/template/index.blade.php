@extends('company::layouts.master_template')
@section('title', "Welcome to company")
@section('content')
    @include('company::template.components._inc_sidebar_left')
    <div class="col-md-10">
        <div class="bs-doc-section clearfix">
            @include('company::template.components._inc_table_list')
        </div>
        <div class="bs-doc-section clearfix">
            @include('company::template.components._inc_form_create')
        </div>
        <div class="bs-doc-section clearfix">
            @include('company::template.components._inc_nav_tab')
        </div>
    </div>

@endsection
