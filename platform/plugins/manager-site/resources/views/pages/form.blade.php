<div class="box box-default" style="padding: 20px 0">
    <form method="post" action="{{ $action }}">
        {{csrf_field()}}
        <div class="form-group clearfix {{ has_error($errors, 'site_name')  }}">
            <label class="col-sm-4">Tên Site <b class="text-danger">(*)</b></label>
            <div class="col-sm-7">
                <input type="text" name="site_name" value="{{ form_input('site_name', $item) }}" class="form-control">
                {!! get_error($errors, 'site_name') !!}
            </div>
        </div>
        <div class="form-group clearfix {{ has_error($errors, 'site_url')  }}" >
            <label class="col-sm-4" >Url <b class="text-danger">(*)</b></label>
            <div class="col-sm-7">
                <input type="text" name="site_url" value="{{ form_input('site_url', $item) }}" class="form-control">
                {!! get_error($errors, 'site_url') !!}
            </div>
        </div>
        <div class="form-group clearfix {{ has_error($errors, 'country')  }}" >
            <label class="col-sm-4" >Country <b class="text-danger">(*)</b></label>
            <div class="col-sm-7">
                <input type="text" name="country" value="{{ form_input('country', $item) }}" class="form-control">
                {!! get_error($errors, 'country') !!}
            </div>
        </div>
        <div class="form-group clearfix {{ has_error($errors, 'site_url')  }}" >
            <label class="col-sm-4" >Châu lục <b class="text-danger">(*)</b></label>
            <div class="col-sm-7">
                <select class="form-control" name="continent" id="">
                    <option value="">--Chọn châu lục--</option>
                    @foreach($continents as $key => $continent)
                        @php $selected = old_selected('continent', $item ?? null, $key) @endphp
                        <option {{ $selected }}

                                value="{{$continent['slug']}}">{{$continent['name']}}</option>
                    @endforeach
                </select>
                {!! get_error($errors, 'continent') !!}
            </div>
        </div>
        <div class="form-group clearfix {{ has_error($errors, 'status')  }}">
            <label class="col-sm-4">Trạng Thái <b class="text-danger">(*)</b></label>
            <div class="col-sm-7">
                <select class="form-control" name="status">
                    <option value="">-- Trạng Thái --</option>
                    @foreach($status as $key => $statusItem)
                        @php $selected = old_selected('status', $item ?? null, $key) @endphp
                        <option {{ $selected }} value="{{ $key }}">{{ $statusItem['name'] }}</option>
                    @endforeach
                </select>
                {!! get_error($errors, 'status') !!}
            </div>
        </div>
        @include('company::components.save_after')
        <div class="form-group clearfix">
            <div class="col-sm-4 col-sm-offset-4">
                <button type="submit" class="btn btn-success">Lưu lại</button>
                <button type="reset" class="btn btn-danger">Huỷ bỏ</button>
            </div>
        </div>
    </form>
</div>
