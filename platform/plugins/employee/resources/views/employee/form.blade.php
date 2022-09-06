<form action="{{ $action }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
        <label class="col-sm-2">Công ty <b class="text-danger">(*)</b></label>
        <div class="col-sm-5">
            <select name="company_id" class="form-control" id="company_id">
                <option value="">-- Công ty --</option>
                @foreach ($companies as $company)
                    <option {{ old_selected('company_id', $user ?? [], $company->id) }} value="{{ $company->id }}">
                        @for ($i = 0; $i < $company['level']; $i++)---@endfor
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            {!! get_error($errors, 'company_id') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('department_id') ? 'has-error' : '' }}">
        <label class="col-sm-2">Phòng ban <b class="text-danger">(*)</b></label>
        <div class="col-sm-5">
            <select name="department_id" class="form-control" id="department_id"
                data-old="{{ old('department_id', $user->department_id ?? 0) }}">
                <option value="">-- Phòng ban --</option>
            </select>
            {!! get_error($errors, 'department_id') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'name') }}">
        <label class="col-sm-2">Họ và tên <b class="text-danger">(*)</b></label>
        <div class="col-sm-5 ">
            <input type="text" class="form-control" name="name" value="{{ form_input('name', $user ?? null) }}"
                placeholder="Name" />
            {!! get_error($errors, 'name') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'date_of_birth') }}">
        <label class="col-sm-2">Ngày sinh <b class="text-danger">(*)</b></label>
        <div class="col-sm-5 ">
            <input type="date" class="form-control" name="date_of_birth"
                value="{{ form_input('date_of_birth', $user ?? null) }}" />
            {!! get_error($errors, 'date_of_birth') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'email') }}">
        <label class="col-sm-2 ">Email <b class="text-danger">(*)</b></label>
        <div class="col-sm-5 ">
            <input type="email" class="form-control" name="email" value="{{ form_input('email', $user ?? null) }}"
                placeholder="Email" />
            {!! get_error($errors, 'email') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'phone') }}">
        <label class="col-sm-2 ">Phone <b class="text-danger">(*)</b></label>
        <div class="col-sm-5 ">
            <input type="tel" class="form-control" name="phone" pattern="[0-9]{10}"
                value="{{ form_input('phone', $user ?? null) }}" placeholder="Phone" />
            {!! get_error($errors, 'phone') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ has_error($errors, 'skype') }}">
        <label class="col-sm-2 ">Skype <b class="text-danger">(*)</b></label>
        <div class="col-sm-5 ">
            <input type="text" class="form-control" name="skype" value="{{ form_input('skype', $user ?? null) }}"
                placeholder="skype" />
            {!! get_error($errors, 'skype') !!}
        </div>
    </div>
    @if (empty($user))
        <div class="form-group clearfix {{ has_error($errors, 'pwd') }}">
            <label class="col-sm-2">Mật khẩu <b class="text-danger">(*)</b></label>
            <div class="col-sm-5 ">
                <input type="text" class="form-control" name="pwd" value="{{ form_input('pwd', $user ?? null) }}"
                    placeholder="Default password" />
                {!! get_error($errors, 'pwd') !!}
            </div>
        </div>
    @endif

    <div class="form-group clearfix ">
        <label class="col-sm-2 ">Vai trò / Phân quyền</label>
        <div class="col-sm-5  role_list">
            @php
                $user_role= [''];
                if(isset($user)){
                    $user_role = $user->roles->pluck('name')->toArray();
                    // dd($user_role);
                }
            @endphp
            @foreach ($roles as $role)
                <div class="role_list-item">
                    <label class="form-check-label" for="{{ $role->name }}">
                        <input type="checkbox" id="{{ $role->name }}" class="form-check-input" name="role[]"
                            value="{{ $role->name }}"
                            {{ (is_array(old('role')) && in_array($role->name, old('role'))) || in_array($role->name, $user_role) ? ' checked' : '' }} />
                        {{ $role->title }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group clearfix {{ has_error($errors, 'role') }} ">
        <label class="col-sm-2 "></label>
        <div class="col-sm-5 ">
            {!! get_error($errors, 'role') !!}
        </div>
    </div>
    @include('plugins.employee::components.save_after')
    <div class="form-group clearfix">
        <div class="col-sm-3 col-sm-offset-2">
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
        </div>
    </div>
</form>

@section('script')
    <script>
        console.log(1);

        function loadDepartmentByCompanyId(company_id, department_id) {
            $.ajax({
                url: '{{ route('get.department.list_child') }}',
                type: 'GET',
                dataType: 'html',
                data: {
                    company_id: company_id,
                    parent_id: department_id,
                },
                success: function(response) {
                    if (response) $('#department_id').html(response);
                }
            })
        }

        $(function() {
            // Autoload
            let company_id = $('#company_id').val();
            let department_id = $('#department_id').attr('data-old');

            // Company change
            $('#company_id').change(function() {
                let company_id = $(this).val();
                loadDepartmentByCompanyId(company_id, 0)
            })

            if (company_id) {
                loadDepartmentByCompanyId(company_id, department_id);
            }
        })

    </script>
@stop
