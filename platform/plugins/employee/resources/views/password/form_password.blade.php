<form action="{{ $action }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group clearfix {{ has_error($errors, 'oldPwd')  }}">
        <label class="col-sm-3">Old password <b class="text-danger">(*)</b></label>
        <div class="col-sm-7 col-md-offset-1 password">
            <input type="password" class="form-control" name="oldPwd" id="oldPwd"
                   value="{{ form_input('oldPwd', $user ?? null) }}"/>
            {!! get_error($errors, 'oldPwd') !!}
            <i class="fa fa-eye"></i>
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'newPwd')  }}">
        <label class="col-sm-3 ">New Password <b class="text-danger">(*)</b></label>
        <div class="col-sm-7 col-md-offset-1 password">
            <input type="password" class="form-control" name="newPwd" id="newPwd"
                   value="{{form_input('newPwd', $user ?? null) }}"/><i class="fa fa-eye"></i>
            {!! get_error($errors, 'newPwd') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'rePwd')  }}">
        <label class="col-sm-4 ">Repeat New Password <b class="text-danger">(*)</b></label>
        <div class="col-sm-7 password">
            <input type="password" class="form-control" name="rePwd" id="rePwd"
                   value="{{form_input('rePwd', $user ?? null) }}"/><i class="fa fa-eye"></i>
            {!! get_error($errors, 'rePwd') !!}
        </div>
    </div>

    <div class="form-group clearfix">
        <div class="col-sm-4 col-sm-offset-4">
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
        </div>
    </div>
</form>
