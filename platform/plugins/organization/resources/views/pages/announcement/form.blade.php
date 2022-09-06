<form action="{{ $action }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group clearfix {{ $errors->has('company_id') ? 'has-error' : '' }}">
        <label class="col-sm-3">Công ty <b class="text-danger">(*)</b></label>
        <div class="col-sm-9">
            <select name="company_id" class="form-control" id="company_id">
                <option value="">-- Công ty --</option>
                @foreach($companies as $company)
                    @php
                        $selected = old_selected('company_id', $item ?? '', $company['id']);
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

    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
        <label class="col-md-3 required">Loại thông báo: <b class="text-danger">(*)</b></label>
        <div class="col-sm-9">
            <select name="type" id="type" class="form-control">
                <option value="" selected="selected">- Loại -</option>
                @foreach($type as $key => $typeItem)
                    @php
                        $selected = old_selected('type', $item ?? '', $key);
                    @endphp
                    <option {{ $selected }} value="{{ $key }}"> {{ $typeItem['name'] }} </option>
                @endforeach
            </select>
            {!! get_error($errors, 'type') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('name') ? 'has-error' : '' }}">
        <label class="col-sm-3">Tên thông báo: <b class="text-danger">(*)</b></label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name"
                   value="{{old('name', isset($item) ? $item->name  : '')}}" placeholder="Tên thông báo"/>
            {!! get_error($errors, 'name') !!}
        </div>
    </div>

    <div class="form-group clearfix {{ $errors->has('hash_tag') ? 'has-error' : '' }}">
        <label class="col-sm-3">Gắn nhãn:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="hash_tag"
                   value="{{old('hash_tag', isset($item) ? $item->hash_tag  : '')}}" placeholder="hash_tag"/>
            {!! get_error($errors, 'hash_tag') !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3"></label>
        <div class="col-sm-9">
            @foreach($status as $key => $statusItem)
                @php $checked = old_checked('status', $item ?? '', $key); @endphp
                <label class="radio radio-inline">
                    <input type="radio" {{ $checked }} value="{{ $key }}"
                           name="status">{{ $statusItem['name'] }}</label>
            @endforeach
            <ul class="nav parsley-description-list">
                <li>nội dung bị ẩn sẽ chỉ có bạn xem được thông báo!</li>
            </ul>
        </div>
    </div>

    <div class="form-group {{ $errors->has('files') ? 'has-error' : '' }}">
        <label class="col-md-3">File upload:</label>
        <div class="col-md-8">
            <input type="file" name="files[]" multiple id="fileUpload">
            {!! get_error($errors, 'files') !!}
            @if (isset($item) && $item->medias())
                <div>
                    @foreach($item->medias() as $key => $file)
                        <p style="margin: 5px 0 0 0">{{ $file->md_origin_name}}</p>
                    @endforeach
                    <em class="text-danger" style="margin-top: 5px">Khi tải lại file thì toàn bộ file cũ sẽ được thay thế</em>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group"><label class="col-md-3"> Bắt buộc đọc:</label>
        <div class="col-md-8">
            <input type="hidden" name="must_read" value="0">
            <label for="must_read">
                @php $checked = old_checked('must_read', $item ?? '', 1); @endphp
                <input type="checkbox" {{ $checked }} name="must_read" id="must_read" value="1"> Thông báo bắt buộc nhân
                viên đọc
            </label>
        </div>
    </div>

    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        <label class="col-md-3 required">Nội dung thông báo: <span class="required">*</span> </label>
        <div class="col-md-9">
            <textarea name="content" class="form-control" cols="30" rows="5"
                      placeholder="Nhập nội dung thông báo" id="announcement-content">{{ form_input('content', $item ?? []) }}</textarea>
            <script>
                CKEDITOR.config.filebrowserImageUploadUrl = '{!! route('post.announcement.upload-image').'?_token='.csrf_token() !!}';
            </script>
            <span class="help-block">{{ $errors->first('type') }}</span>
        </div>
    </div>

    @include('plugins.organization::components.save_after')

    <div class="form-group clearfix">
        <div class="col-sm-3 col-sm-offset-3">
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <button type="reset" class="btn btn-default">Huỷ bỏ</button>
        </div>
    </div>
</form>
