@php
    $payloads =isset($item) ? json_decode($item->payload_rule) : [];


@endphp

<div class="tab-panel">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="">
                        <label for="">Payload rules</label>
                        @if(isset($item)  && $payloads !=null)
                            @foreach($payloads as $keyParent => $payload)
                            <div class="js-payload-and">
                                <div  style="border:1px solid #d2d6de;padding: 10px 30px;position: relative" class="form-group   ">
                                    <button class="btn-close-group-payload" style="position: absolute;left: -10px" ><span>X</span></button>
                                    <label for="">And rule</label>
                                    <table class="js-table-add-and table table-sm table-striped m-b-0">
                                        <thead style="width: 100%">
                                        <tr>
                                            <th>Key </th>
                                            <th>Condition</th>
                                            <th>Value</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody class="js-array-row">
                                       @foreach($payload as $keyChild => $childPay)
                                        <tr class="js-row-add-and">
                                            <td>
                                                <input value="{{$childPay->name}}" name="payload_rule[{{$keyParent}}][{{$keyChild}}][name]" type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input value="{{$childPay->condition}}" name="payload_rule[{{$keyParent}}][{{$keyChild}}][condition]" type="text" class="form-control">
                                            </td>
                                            <td>
                                                <input value="{{$childPay->value}}" name="payload_rule[{{$keyParent}}][{{$keyChild}}][value]" type="text" class="form-control">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm js-remove-add-and "><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                       @endforeach
                                        </tbody>
                                    </table>
                                    <div class="">
                                        <button  style="margin-left: 5px" class="btn-default btn btn-sm js-add-and"> <i class="fa fa-plus"></i> Add and</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="js-payload-group">

                            </div>
                        @endif
                        <div class="">
                            <button type="button" id="btn-add-group-payload" style="" class="btn btn-outline-primary btn-sm"><i
                                    class="fa fa-plus"></i> Add OR Group
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
