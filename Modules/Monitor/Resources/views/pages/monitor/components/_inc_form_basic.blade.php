
<div class="tab-pane">
    <div class="row">
        <div class="col-md-12">
           <div class="panel panel-default">
               <div class="panel-heading">
                   <h3 class="panel-title">Thông tin cơ bản</h3>
               </div>
               <div class="panel-body">
                   <div class="form-group">
                       <label>Name <span class="text-danger">(*)</span></label>
                       <input name="name" value="{{old('name', isset($item) ? $item->name  : '')}}" class="form-control" type="text">
                   </div>
                   <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                       <label class=" control-label">Url <span class="text-danger">(*)</span></label>
                       <input value="{{old('url', isset($item) ? $item->url  : '')}}" name="url" class="form-control" type="text">
                       {!! get_error($errors,'url')  !!}
                   </div>
                   <div class="form-group {{ $errors->has('site_id') ? 'has-error' : '' }}">
                       <label>Site <span class="text-danger">(*)</span></label>
                       <select class="form-control " name="site_id" id="">
                           <option value="">--Chọn site--</option>
                           @foreach($sites as $key => $site)
                               <option {{ old_selected('site_id', $item ?? [], $site->id) }} value="{{$site->id}}">{{$site->site_name}}</option>
                           @endforeach
                       </select>
                       {!! get_error($errors,'site_id')  !!}
                   </div>
                   <div class="form-group">
                       <div class="">
                           <input {{isset($item) && $item->uptime_check_enabled == 1 ? 'checked' : '' }} name="uptime_check_enabled"  id="uptime_check" type="checkbox">
                           <label for="uptime_check">Uptime check enabled</label>
                       </div>
                       <div class="">
                           <input {{isset($item) && $item->certificate_check_enabled == 1 ? 'checked' : '' }} name="certificate_check_enabled" id="certificate_check" type="checkbox">
                           <label for="certificate_check"> Certificate check enabled</label>
                       </div>
                   </div>
                   <div class="form-group">
                       <label>Check interval in minutes </label>
                       <input value="{{old('url', isset($item) ? $item->uptime_check_interval_in_minutes  : '')}}"  name="uptime_check_interval_in_minutes" class="form-control" type="text">
                   </div>
                   <div class="form-group">
                       <label>Uptime check payload</label>
                       <textarea name="uptime_check_payload" id="" class="form-control">{{old('uptime_check_payload', isset($item) ? $item->uptime_check_payload  : '')}}</textarea>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>
