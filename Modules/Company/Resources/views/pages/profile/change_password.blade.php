@extends('company::layouts.master')
@section('title', "Đổi mật khẩu")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    <div class="row">
        <form method="post" action="{{ route('post.profile.update_passsword') }}">
            @csrf
            <div class="form-horizontal">
                <div class="col-md-6 ">
                    <fieldset style="margin-bottom: 0">
                        <div class="form-group {{ has_error($errors, 'old_password')  }}">
                            <label class="col-md-4 control-label">Mật khẩu cũ: <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="password" name="old_password" maxlength="255" class="form-control">
                                {!! get_error($errors, 'old_password') !!}
                            </div>
                        </div>
                        <div class="form-group {{ has_error($errors, 'new_password')  }}">
                            <label class="col-md-4 control-label">Mật khẩu mới: <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="password" name="new_password" maxlength="255" class="form-control">
                                {!! get_error($errors, 'new_password') !!}
                            </div>
                        </div>
                        <div class="form-group {{ has_error($errors, 'confirm_password')  }}">
                            <label class="col-md-4 control-label">Nhập lại mật khẩu mới: <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="password" name="confirm_password" maxlength="255" class="form-control">
                                {!! get_error($errors, 'confirm_password') !!}
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div style="clear:both"></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4"></label>
                        <div class="col-md-8">
                            <button class="btn btn-primary">
                                Lưu mật khẩu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
@section('script')

@stop
