<form action="{{ $action }}" method="POST" ">
{{ csrf_field() }}
{{ method_field('POST') }}
<div class="row">
    <div class="col-md-12">
        <div class="form-group clearfix {{ has_error($errors, 'title') }}">
            <label class="col-sm-2">Tên module <b class="text-danger">(*)</b></label>
            <div class="col-sm-6 ">
                <input type="text" class="form-control" name="title"
                       value="{{ form_input('title', $module ?? null) }}" />
                {!! get_error($errors, 'title') !!}
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group clearfix">
            <div class="col-sm-4 col-sm-offset-2">
                <button type="submit" class="btn btn-success">Lưu lại</button>
                <button type="reset" class="btn btn-default">Huỷ bỏ</button>
            </div>
        </div>
    </div>
</div>
</form>
