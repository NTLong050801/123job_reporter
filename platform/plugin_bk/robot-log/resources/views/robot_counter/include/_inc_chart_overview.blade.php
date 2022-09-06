<div class="tab-pane active" id="overview">
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
        @foreach($data['data_over_view'] as $bot => $dataBot)
            <div style="flex: 0 0 49%">
                <h3><b>{{ $bot }}</b></h3>
                @php
                    $chartName = 'chart-overview-'.$bot;
                    $dataChart[$chartName] = $dataBot;
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