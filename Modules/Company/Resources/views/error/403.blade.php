@extends('company::layouts.master')
@section('title', "Welcome to Reporter")
@section('content')
    <h1>Bạn không có quyền truy cập. </h1>
    Chúc bạn một ngày làm việc hiệu quả. Hiện tại là: {{ now() }}
@endsection
