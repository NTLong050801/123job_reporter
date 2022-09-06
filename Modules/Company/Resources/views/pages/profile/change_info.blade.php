@extends('company::layouts.master')
@section('title', "Đổi thông tin cá nhân")
@section('em', "Các trường có dấu * là bắt buộc phải nhập")
@section('content')
    <div class="row">
        <form method="post" action="{{ route('post.profile.update_info') }}">
            @csrf
            <div class="form-horizontal">
                <div class="col-md-6 ">
                    <fieldset style="margin-bottom: 0">
                        <div class="form-group {{ has_error($errors, 'phone')  }}">
                            <label class="col-md-4 control-label">Số điện thoại: <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="text" name="phone" maxlength="255" class="form-control" value="{{old('phone', Auth::guard('admins')->user()->phone)}}">
                                {!! get_error($errors, 'phone') !!}
                            </div>
                        </div>
                        <div class="form-group {{ has_error($errors, 'email')  }}">
                            <label class="col-md-4 control-label">Email: <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="email" name="email" maxlength="255" class="form-control" value="{{old('email', Auth::guard('admins')->user()->email)}}">
                                {!! get_error($errors, 'email') !!}
                            </div>
                        </div>
                        <div class="form-group {{ has_error($errors, 'skype')  }}">
                            <label class="col-md-4 control-label">Skype: <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="text" name="skype" maxlength="255" class="form-control" value="{{old('skype', Auth::guard('admins')->user()->skype)}}">
                                {!! get_error($errors, 'skype') !!}
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
                                Lưu
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
