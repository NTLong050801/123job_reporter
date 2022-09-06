@foreach($data['data_bot'] as $bot => $dataBot)
    <div class="tab-pane"
         id="{{ $bot }}">
        <h3>Report by</h3>
        <ul class="nav nav-tabs">
            @foreach($dataBot as $type => $dataType)
                <li class="{{ $type == array_first(array_keys($dataBot)) ? 'active' : '' }}">
                    <a href="#{{ $bot }}-{{ $type }}" data-toggle="tab">{{ $type }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($dataBot as $type => $dataType)
                <div class="tab-pane {{ $type == array_first(array_keys($dataBot)) ? 'active' : '' }}"
                     id="{{ $bot }}-{{ $type }}">
                    <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                        @foreach($dataType as $key => $dataKey)
                            <div style="flex: 0 0 49%">
                                <h3><b>{{ $key }}</b></h3>
                                @php
                                    $key = str_replace('/', '-', $key);
                                    $chartName = 'chart-'.$bot.'-'.$type.'-'.$key;
                                    $dataChart[$chartName] = $dataKey;
                                @endphp
                                <div id="{{ $chartName }}" style="border: 1px solid #dddddd; padding: 10px">
                                    <div class="img-loading text-center">
                                        <img src="http://pa1.narvii.com/7491/d8b2fb62d9bc8d6c042da4fd6ad5be92a8d97825r1-200-200_00.gif" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach