<form action="{{ $action }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group clearfix {{ $errors->has('menu_name') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label">Tên Menu <b class="text-danger">(*)</b></label>
        <div class="col-sm-7 col-md-offset-1">
            <input type="text" class="form-control" name="menu_name"
                   value="{{old('menu_name', isset($item) ? $item->menu_name  : '')}}" placeholder="Tên "/>
            {!! get_error($errors, 'menu_name') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('menu_slug') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label">Tên slug <b class="text-danger">(*)</b></label>
        <div class="col-sm-7 col-md-offset-1">
            <input type="text" class="form-control" name="menu_slug"
                   value="{{old('menu_slug', isset($item) ? $item->menu_slug  : '')}}" placeholder="Slug "/>
            {!! get_error($errors, 'menu_slug') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('menu_sort') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label">Sắp xếp</label>
        <div class="col-sm-7 col-md-offset-1">
            <input type="text" class="form-control" name="menu_sort"
                   value="{{old('menu_sort', isset($item) ? $item->menu_sort  : '')}}" placeholder="Sort order "/>
            {!! get_error($errors, 'menu_sort') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('menu_status') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label">Trạng thái</label>
        <div class="col-sm-7 col-md-offset-1">
            <select name="menu_status" class="form-control">
                <option value="">-- Chọn trạng thái --</option>
                @foreach($status as $key => $statusItem)
                    <option {{ old_selected('menu_status', $item ?? [], $key) }} value="{{ $key }}">{{ $statusItem['name'] }}</option>
                @endforeach
            </select>
            {!! get_error($errors, 'menu_status') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('menu_icon') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label">Icon</label>
        <div class="col-sm-7 col-md-offset-1">
            <input type="text" class="form-control" name="menu_icon"
                   value="{{old('menu_icon', isset($item) ? $item->menu_icon  : '')}}" placeholder="Icon "/>
            {!! get_error($errors, 'menu_icon') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('menu_link') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label">Đường dẫn</label>
        <div class="col-sm-7 col-md-offset-1">
            <input type="text" class="form-control" name="menu_link"
                   value="{{old('menu_link', isset($item) ? $item->menu_link  : '')}}" placeholder="Link "/>
            {!! get_error($errors, 'menu_link') !!}
            <div class="text-muted mt-5">Đường dẫn có dạng : /timnha247/abc</div>
        </div>
    </div>

    @include('company::components.save_after')

    <div class="form-group clearfix">
        <div class="col-sm-4 col-sm-offset-4">
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
        </div>
    </div>
</form>
