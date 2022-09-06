<form method="POST" action="{{ $action }}">
    {{ csrf_field() }}

    {{--<div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">--}}
        {{--<label class="col-sm-3 control-label">Công ty: <b class="text-danger">(*)</b></label>--}}
        {{--<div class="col-sm-7 col-md-offset-1">--}}
            {{--<select name="company_id" class="form-control" id="company_id">--}}
                {{--<option value="">-- Công ty --</option>--}}
                {{--@foreach($companies as $company)--}}
                    {{--@php--}}
                        {{--$selected = old('company_id', isset($item) ? $item->company_id : '') == $company['id'] ? 'selected' : '';--}}
                    {{--@endphp--}}
                    {{--<option {{ $selected }} value="{{ $company->id }}">--}}
                        {{--@for($i=0; $i < $company['level']; $i++)---@endfor--}}
                        {{--{{ $company->name }}--}}
                    {{--</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--<span class="help-block">{{ $errors->first('company_id') }}</span>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="form-group clearfix {{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Vai trò: <b class="text-danger">(*)</b></label>
        <div class="col-sm-7 col-md-offset-1">
            <input type="text" id="title" name="title" value="{{ old('title',$item->title ??'')}}"
                   class="form-control name" placeholder="Title"/>
            <span class="help-block">{{ $errors->first('title') }}</span>
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Tên chức danh: <b class="text-danger">(*)</b></label>
        <div class="col-sm-7 col-md-offset-1">
            <input type="text" id="name" name="name" value="{{ old('name',$item->name ??'')}}"
                   class="form-control name" placeholder="Tên"/>
            <span class="help-block">{{ $errors->first('name') }}</span>
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('description') ? ' has-error' : '' }}">
        <label class="col-sm-3 control-label">Mô tả vị trí: </label>
        <div class="col-sm-7 col-md-offset-1">
            <textarea name="description" class="form-control" cols="30" rows="3"
                      placeholder="Mô tả">{{ old('description',$item->description ??'')}}</textarea>
            <span class="help-block">{{ $errors->first('description') }}</span>
        </div>
    </div>

    @include('plugins.acl::components.save_after')
    <div class="form-group clearfix">
        <div class="col-sm-4 col-sm-offset-4">
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
        </div>
    </div>

</form>
