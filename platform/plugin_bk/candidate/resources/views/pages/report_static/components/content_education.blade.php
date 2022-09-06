<h3 style="margin:10px 0 15px 0; font-size: 22px;">Trình độ học vấn</h3>
<div class="table-responsive">
    <table class="table table-hover table-stripe table-bordered" id="sort-table">
        <thead class="thead-header">
        <tr class="tr-header" style="display: none">
            <th width="2%">ID</th>
            <th width="150px" style="min-width: 150px;">Bằng cấp</th>
            @foreach($times as $time)
                <th width="{{ 75 / count($times) . '%' }}">{{ $time }}</th>
            @endforeach
            <th width="5%">Tổng</th>
        </tr>
        <tr>
            <th width="2%">ID</th>
            <th width="150px" style="min-width: 150px;">Cấp bậc</th>
            @foreach($times as $time)
                <th width="{{ 75 / count($times) . '%' }}">{{ $time }}</th>
            @endforeach
            <th width="5%">Tổng</th>
        </tr>
        </thead>
        <tbody>
        @php $sum_total = 0 @endphp
        @foreach($reports as $item)
            <tr>
                <td width="2%" class="fixed">{{ $item['id'] }}</td>
                <th width="150px" style="min-width: 150px;">{{ $item['name'] }}</th>
                @php $sum = 0 @endphp
                @foreach($times as $time)
                    @php
                        $total = $item['report'][$time] ?? 0;
                        $sum += $total;
                    @endphp
                    <td width="{{ 75 / count($times) . '%' }}" {{ $total == 0 ? 'class=danger' : '' }}
                    aria-label="{{ $time }}" data-microtip-position="top" role="tooltip">
                        {{ number_format($total,0,",",".") }}
                    </td>
                @endforeach
                @php $sum_total += $sum; @endphp
                <th width="5%" {{ $sum == 0 ? 'class=danger' : 'class=success' }}
                aria-label="Tổng" data-microtip-position="top" role="tooltip">{{ number_format($sum,0,",",".") }}</th>
            </tr>
        @endforeach
        </tbody>
        <tr class="success">
            <td></td>
            <th>Tổng</th>
            @foreach($times as $time)
                @php $sum = 0 @endphp
                @foreach($reports as $report)
                    @php
                        $sum += $report['report'][$time] ?? 0;
                    @endphp
                @endforeach
                <th {{ $sum == 0 ? 'class=danger' : '' }}>{{ number_format($sum,0,",",".") }}</th>
            @endforeach
            <td>{{ number_format($sum_total,0,",",".") }}</td>
        </tr>
    </table>
</div>
