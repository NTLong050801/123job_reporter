@extends('company::layouts.master')
@section('title', 'Thông tin cá nhân')
@section('content')
    <div class="col-md-3 profile">
        <div class="user-info-left">
            <div class="image-area" style="width:129px;height:129px;overflow:hidden;margin-left: 30px;">
                <img style="width:100%;height:100%;object-fit: cover;" alt="Không có ảnh đại diện"
                    src="{{ $pathAvatar }}" onerror="{{ asset('images/no-image.png') }}">
            </div>
            <div class="username-area" style="width:129px;overflow:hidden;margin-left: 30px;">
                <h2>
                    {{ Auth::guard('admins')->user()->name }}
                </h2>
            </div>
        </div>
        <div class="col-md-12">
            <fieldset>
                <div class="form-group">
                    <div class="col-md-12">
                        <form action="{{ route('post.profile.upload_avatar') }}" method="post" id="uploadFile"
                            style="height: 80px; overflow: hidden;" class="dz-clickable" enctype="multipart/form-data">
                            @csrf
                            <div class="uploadDescription dz-clickable dz-message">
                                <label class=" text-muted" style="cursor: pointer">
                                    <input type="file" style="display: none" name="avatar">
                                    <i class="fa fa-upload"></i>
                                    <b>Click vào để upload</b>
                                </label>
                                <br>
                                <span class="fonsize-100 text-muted">
                                    (Dung lượng nhỏ hơn 3Mb)
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12" id="previewsContainer"></div>
                    <br>
                </div>
            </fieldset>
            <div id="preview-template" style="display: none;">
                <div class="dz-preview dz-file-preview col-md-3 status-uploading">
                    <div class="item">
                        <div class="item-preview">
                            <div class="dz-image">
                                <img data-dz-thumbnail="">
                            </div>
                        </div>
                        <div class="item-info">
                            <div class="dz-details">
                                <div class="size">
                                    <div class="dz-size">
                                        <span data-dz-size=""></span>
                                    </div>
                                </div>
                                <div class="name fontsize-85">
                                    <div class="dz-filename">
                                        <span data-dz-name=""></span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width: 0%;" data-dz-uploadprogress="">
                                </div>
                            </div>
                            <div class="dz-error-message">
                                <span data-dz-errormessage=""></span>
                            </div>
                            <div class="dz-success-mark">
                                <i class="fa-fa-check color-green"></i>
                            </div>
                            <div class="dz-error-mark">
                                <i class="fa-fa-times color-red"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="user-info-right">
            <div class="basic-info dl-horizontal">
                <div class="title col-md-12">
                    <i class="fa fa-check"></i> Thông tin cơ bản
                </div>
                <dl class="data-row col-md-12">
                    <dt>Họ và tên:</dt>
                    <dd>
                        {{ Auth::guard('admins')->user()->name }}
                    </dd>
                </dl>
                <dl class="data-row col-md-12">
                    <dt>Mã Code:</dt>
                    <dd>
                        {{ get_data_user('admins', 'id') }}
                    </dd>
                </dl>
                <dl class="data-row col-md-12">
                    <dt>Chức vụ:</dt>
                    <dd>
                        @foreach (Auth::guard('admins')->user()->roles as $role)
                            {{ $role->title }}
                        @endforeach
                    </dd>
                </dl>
                <dl class="data-row col-md-12">
                    <dt>Ngày tạo tài khoản:</dt>
                    <dd>
                        {{ date('d/m/Y', strtotime(Auth::guard('admins')->user()->created_at)) }}
                    </dd>
                </dl>
            </div>

            <div class="contact_info dl-horizontal">
                <div class="title col-md-12">
                    <i class="fa fa-check"></i> Liên hệ
                    <div style="float:right;cursor:pointer;">
                        <a href="{{ route('get.profile.change_info') }}">
                            <span class="edit-item">
                                <i class="fa fa-edit text-info"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <dl class="data-row col-md-12">
                    <dt class="phone">Số điện thoại:</dt>
                    <dd>
                        {{ Auth::guard('admins')->user()->phone }}
                    </dd>
                </dl>
                <dl class="data-row col-md-12">
                    <dt>Email cá nhân:</dt>
                    <dd class="email">
                        {{ Auth::guard('admins')->user()->email }}
                    </dd>
                </dl>
                <dl class="data-row col-md-12">
                    <dt>Skype:</dt>
                    <dd>
                        {{ Auth::guard('admins')->user()->skype }}
                    </dd>
                </dl>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $('#uploadFile').change(function() {
            $(this).submit();
        });

    </script>
@stop
