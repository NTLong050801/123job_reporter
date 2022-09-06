<div class="pull-left">
    <p style="margin-top: 10px;">{{ $candidates->firstItem() .'/'.$candidates->lastItem().' Trong '.$candidates->total() }} records</p>
</div>
<table class="table table-hover table-stripe table-bordered">
    <thead>
    <tr>
        <th width="4%">ID</th>
        <th>Họ và tên</th>
        <th>Thời gian</th>
        <th>Nhóm nghề nghiệp</th>
        <th>Cấp bậc cao nhất</th>
        <th>Trình độ học vấn</th>
    </tr>
    </thead>
    <tbody>
    @foreach($candidates as $candidate)
        <tr>
            <td>{{ $candidate->id ?? 'N/A' }}</td>
            <td>
                <a href="javascript:void(0)"
                   style="color: #337ab7;"
                   class="js-candidate-detail"
                   data-id="{{ $candidate->id }}"
                   data-candidate="{{ $candidate }}">{{ $candidate->name ?? '' }}
                </a>
            </td>
            <td>{{ \Carbon\Carbon::createFromTimestamp($candidate->timestamp)->format('d/m/Y') }}</td>
            <td>{{ $candidate->career_text }}</td>
            <td>{{ $candidate->rank_text }}</td>
            <td>{{ $candidate->degree_text }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="custome-paginate">
    <div class="pull-left">
        <p style="margin-top: 20px;">{{ $candidates->firstItem() .'/'.$candidates->lastItem().' Trong '.$candidates->total() }} records</p>
    </div>
    <div class="pull-right">
        {{ $candidates->appends($query)->render() }}
    </div>
</div>
