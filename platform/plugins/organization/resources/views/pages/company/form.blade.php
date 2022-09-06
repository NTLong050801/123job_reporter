<form action="{{ $action }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group clearfix {{ has_error($errors, 'parent_id')}}">
        <label class="col-sm-3">Công ty mẹ</label>
        <div class="col-sm-7">
            <select name="parent_id" class="form-control" id="parent_id">
                <option value="">-- Công ty mẹ -- </option>
                @foreach($companies as $company)
                    @php
                        $selectezd = old('parent_id', isset($item) ? $item->parent_id : '') == $company['id'] ? 'selected' : '';
                    @endphp
                    <option {{ $selected ?? ''}} value="{{ $company->id }}">
                        @for($i=0; $i < $company['level']; $i++)---@endfor
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            {!! get_error($errors, 'parent_id') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('name') ? 'has-error' : '' }}">
        <label class="col-sm-3">Tên công ty <b class="text-danger">(*)</b></label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="name"
                   value="{{old('name', isset($item) ? $item->name  : '')}}" placeholder="Tên công ty"/>
            {!! get_error($errors, 'name') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('address') ? 'has-error' : '' }}">
        <label class="col-sm-3">Địa chỉ</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="address"
                   value="{{old('address', isset($item) ? $item->address  : '')}}" placeholder="address"/>
            {!! get_error($errors, 'address') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('status') ? 'has-error' : '' }}">
        <label class="col-sm-3">Trạng thái</label>
        <div class="col-sm-7">
            <select name="status" class="form-control">
                <option value="">-- Chọn trạng thái -- </option>
                @foreach($status as $key => $statusItem)
                    <option {{ old_selected('status', $item ?? [], $key) }} value="{{ $key }}">{{ $statusItem['name'] }}</option>
                @endforeach
            </select>
            {!! get_error($errors, 'status') !!}
        </div>
    </div>
    @include('plugins.organization::components.save_after')
    <div class="form-group clearfix">
        <div class="col-sm-4 col-sm-offset-3">
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
        </div>
    </div>
</form>
