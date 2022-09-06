<form method="POST" action="{{ $action }}" class="form-horizontal">
    {{ csrf_field() }}

    <div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
        <label class="col-sm-4">Công ty: <b class="text-danger">(*)</b></label>
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

    <div class="form-group clearfix {{ $errors->has('type') ? 'has-error' : '' }}">
        <label class="col-sm-4">Hình thức thanh toán: <b class="text-danger">(*)</b></label>
        <div class="col-sm-7">
            <select name="type" class="form-control">
                <option value="">-- Hình thức thanh toán --</option>
                @foreach($types as $key => $typeItem)
                    <option {{ old_selected('type', $item ?? [], $key) }} value="{{ $key }}">{{ $typeItem['name'] }}</option>
                @endforeach
            </select>
            {!! get_error($errors, 'type') !!}
        </div>
    </div>

    <div class="form-group clearfix">
        <label class="col-md-4">Sản phẩm cha:</label>
        <div class="col-md-7">
            <select name="parent_id" id="parent_id" class="form-control"
                    data-old="{{ old('parent_id', $item->parent_id ?? null) }}">
                <option value="">- Sản phẩm -</option>
            </select>
            {!! get_error($errors, 'parent_id') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-4">Tên sản phẩm: <b class="text-danger">(*)</b></label>
        <div class="col-sm-7">
            <input type="text" id="name" autocomplete="false" name="name" value="{{ old('name',$item->name ??'')}}"
                   class="form-control name" placeholder="Tên"/>
            {!! get_error($errors, 'name') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('price') ? ' has-error' : '' }}">
        <label class="col-sm-4">Giá sản phẩm(VNĐ) <b class="text-danger">(*)</b>: </label>
        <div class="col-sm-7">
            <input type="text" id="price" autocomplete="false" name="price" value="{{ old('price',$item->price ??'')}}"
                   class="form-control name" placeholder="Giá"/>
            {!! get_error($errors, 'price') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('commission') ? ' has-error' : '' }}">
        <label class="col-sm-4"> Doanh số cho kinh doanh (%): </label>
        <div class="col-sm-7">
            <input type="text" id="commission" autocomplete="false" name="commission"
                   value="{{ old('commission',$item->commission ??'')}}"
                   class="form-control name" placeholder="Doanh số %"/>
            {!! get_error($errors, 'commission') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('status') ? 'has-error' : '' }}">
        <label class="col-sm-4">Trạng thái</label>
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

    <div class="form-group clearfix">
        <label class="col-sm-4">Sau khi lưu</label>
        <span class="col-sm-7">
            <label for="next">
                <input type="radio" id="next" name="redirect" checked value="0">
                Tiếp tục
            </label> &nbsp;
            <label for="back">
                <input type="radio" id="back" name="redirect" value="1">
                Hiện danh sách
            </label>
        </span>
    </div>


    <div class="form-group clearfix">
        <div class="col-sm-4 col-sm-offset-4">
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
        </div>
    </div>

</form>

@section('script')
    <script>
        function getProduct(companyId, parentId) {
            $.ajax({
                url: '{{ route('get.product.list') }}',
                type: 'GET',
                dataType: 'html',
                data: {
                    companyId: companyId,
                    parentId: parentId
                },
                success: function (response) {
                    if (response) $('#parent_id').html(response);
                }
            })
        }

        function loadProduct() {
            let companyId = $('#company_id').val();
            let parentId = $('#parent_id').attr('data-old');
            getProduct(companyId, parentId);
        }

        function selectCompany() {
            $('#company_id').change(function () {
                let companyId = $(this).val();
                getProduct(companyId);
            })
        }

        $(function () {
            selectCompany();
            loadProduct();
        })
    </script>
@stop
