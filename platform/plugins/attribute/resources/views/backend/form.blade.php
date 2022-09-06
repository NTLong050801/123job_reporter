<form method="post" action="{{ $action }}">
    {{csrf_field()}}
    <div class="form-group clearfix {{ has_error($errors, 'name')  }}">
        <label class="col-sm-4">Tên thuộc tính</label>
        <div class="col-sm-7">
            <input type="text" name="name" value="{{ form_input('name', $item) }}" class="form-control" placeholder="Thuộc tính">
            {!! get_error($errors, 'name') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'status')  }}">
        <label class="col-sm-4">Trạng thái</label>
        <div class="col-sm-7">
            <select class="form-control" name="status">
                <option >-- Trạng thái --</option>
                @foreach($status as $key => $statusItem)
                    @php $selected = old_selected('status', $item ?? null, $key) @endphp
                    <option {{ $selected }} value="{{ $key }}">{{ $statusItem['name'] }}</option>
                @endforeach
            </select>
            {!! get_error($errors, 'status') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'type')  }}">
        <label class="col-sm-4">Kiểu thuộc tính</label>
        <div class="col-sm-7">
            <select class="form-control" name="type">
                <option >-- Thuộc tính --</option>
                @foreach($type as $key => $typeItem)
                    @php $selected = old_selected('type', $item ?? null, $key) @endphp
                    <option {{ $selected }} value="{{ $key }}">{{ $typeItem['name'] }}</option>
                @endforeach
            </select>
            {!! get_error($errors, 'type') !!}
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
