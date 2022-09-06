@extends('layouts.app_admin')
@section('content')
    <section class="body-sign login-box">
        <div class="center-sign">
            <div class="panel panel-sign">
                <div class="panel-title-sign mt-xl text-center">
                    <h2 class="title text-weight-bold m-none">Đăng nhập hệ thống</h2>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel-body">
                    <form action="{{ route('post.admin.login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group mb-lg">
                            <input type="text" class="form-control input-lg" autocomplete="false" name="email"
                                   placeholder="Email của bạn" value="{{ old('email') }}"/>
                        </div>
                        <div class="form-group mb-lg">
                            <input name="password" type="password" autocomplete="false" class="form-control input-lg"
                                   placeholder="Mật khẩu của bạn"/>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input id="RememberMe" name="remember" type="checkbox"/>
                                    <label for="RememberMe">Ghi nhớ sử dụng</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-block btn-lg btn-success"> Đăng nhập bắt đầu làm
                                    việc
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2020. System admin</p>
        </div>
    </section>
@stop
