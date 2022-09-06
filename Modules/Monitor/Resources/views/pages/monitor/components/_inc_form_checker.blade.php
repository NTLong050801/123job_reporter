@php
    $additionals = isset($item) ? json_decode($item->additional_headers) : [];
@endphp

<div class="tab-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin chi tiết</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Uptime check response checker</label>
                        <select class="form-control" name="uptime_check_response_checker" id="">
                            @foreach($checkers as $key=> $checker)
                                <option value="{{$key}}">{{$checker['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class=" control-label">Look for string</label>
                        <input value="{{old('look_for_string', isset($item) ? $item->look_for_string  : '')}}"
                               name="look_for_string" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Check method <span class="text-danger">(*)</span></label>
                        <select class="form-control" name="uptime_check_method" id="">
                            @foreach($uptime_check_methods as $key => $uptime_check_method)
                                <option
                                    {{ old_selected('uptime_check_method', $item ?? [], $key) }} value="{{$key}}">{{$uptime_check_method['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Additional headers</label>
                        <table id="table-header" class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Content</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="js-array-row">

                            @if(isset($item))
                                @foreach($additionals as $key => $additional)
                                    <tr class="js-add-tr">
                                        <td>
                                            <input value="{{$additional->name}}" name="additional_headers[{{$key}}][name]" class="form-control" type="text">
                                        </td>
                                        <td>
                                            <input value="{{$additional->content}}" name="additional_headers[{{$key}}][content]" class="form-control" type="text">
                                        </td>
                                        <td class="" style="align-items: center;text-align: center">
                                            <button type="button" class="btn btn-sm js-remove-header btn-danger"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="js-add-tr">
                                    <td>
                                        <input name="additional_headers[0][name]" class="form-control" type="text">
                                    </td>
                                    <td>
                                        <input name="additional_headers[0][content]" class="form-control" type="text">
                                    </td>
                                    <td class="" style="align-items: center;text-align: center">
                                        <button type="button" class="btn btn-sm btn-danger js-remove-header">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="">
                            <button  type="button" class="btn btn-default js-add-header"><i class="fa fa-plus"></i> Add additional headers</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
