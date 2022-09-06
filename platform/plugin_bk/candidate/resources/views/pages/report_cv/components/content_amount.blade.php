{{--<div class="pull-left">--}}
{{--    <p style="margin-top: 10px;">{{ $cv_reports->firstItem() .'/'.$cv_reports->lastItem().' Trong '.$cv_reports->total() }} records</p>--}}
{{--</div>--}}
<table class="table table-hover table-stripe table-bordered">
    <thead>
    <tr>
        <th></th>
        @foreach($cv_reports as $cv)
            <th>{{ $cv->date }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="white-space: nowrap">Số lượng CV mới</td>
        @foreach($cv_reports as $cv)
            <td>{{ number_format($cv->total,0,",",".") }}</td>
        @endforeach
    </tr>
    <tr>
        <td style="white-space: nowrap">Số lượng CV lũy kế</td>
        @foreach($cv_reports as $cv)
            <td>{{ number_format($cv->amount,0,",",".") }}</td>
        @endforeach
    </tr>
    </tbody>
</table>
