<form action="{{ $action }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    <div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
        <label class="col-sm-3">Công ty <b class="text-danger">(*)</b></label>
        <div class="col-sm-7">
            <select name="company_id" class="form-control" id="company_id">
                <option value="">-- Công ty --</option>
                @foreach($companies as $company)
                    @php
                        $selected = old_selected('company_id', $item ?? [], $company['id']);
                    @endphp
                    <option {{ $selected }} value="{{ $company->id }}">
                        @for($i=0; $i < $company['level']; $i++)---@endfor
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            {!! get_error($errors, 'company_id') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('parent_id') ? 'has-error' : '' }}">
        <label class="col-sm-3">Trực thuộc phòng</label>
        <div class="col-sm-7">
            <select name="parent_id" class="form-control" id="parent_id"
                    data-old="{{ old('parent_id', $item->parent_id ?? 0) }}">
                <option value="">-- Phòng ban trực thuộc --</option>
            </select>
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('name') ? 'has-error' : '' }}">
        <label class="col-sm-3">Tên phòng ban <b class="text-danger">(*)</b></label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="name"
                   value="{{old('name', isset($item) ? $item->name  : '')}}" placeholder="name"/>
            {!! get_error($errors, 'name') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('code') ? 'has-error' : '' }}">
        <label class="col-sm-3">Mã code</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="code"
                   value="{{old('code', isset($item) ? $item->code    : '')}}" placeholder="code"/>
            {!! get_error($errors, 'code') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('status') ? 'has-error' : '' }}">
        <label class="col-sm-3">Trạng thái <b class="text-danger">(*)</b></label>
        <div class="col-sm-7">
            <select name="status" class="form-control">
                <option value="">-- Chọn trạng thái --</option>
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


@section('script')
    <script>
        function loadDepartmentByCompanyId(company_id, parent_id) {
            $.ajax({
                url: '{{ route('get.department.list_child') }}',
                type: 'GET',
                dataType: 'html',
                data: {
                    company_id: company_id,
                    parent_id: parent_id
                },
                success: function (response) {
                    if (response) $('#parent_id').html(response);
                }
            })
        }

        $(function () {
            // Autoload
            let company_id = $('#company_id').val();
            let parent_id = $('#parent_id').attr('data-old');

            // Company change
            $('#company_id').change(function () {
                let company_id = $(this).val();
                loadDepartmentByCompanyId(company_id, parent_id)
            })

            if (company_id) {
                loadDepartmentByCompanyId(company_id, parent_id);
            }
        })
    </script>
@stop
