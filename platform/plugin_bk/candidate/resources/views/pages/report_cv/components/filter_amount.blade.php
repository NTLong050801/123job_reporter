<div class="form-search pull-left fFilterC">
    <form action="{{ route('get.report_cv.amount') }}" method="get" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" name="month_range" placeholder="Chọn tháng" value="{{ array_get($query, 'month_range') }}" autocomplete="off">
        </div>
        <div class="form-group">
            <select name="source" class="form-control select2" id="source">
                <option value="">-- Nguồn --</option>
                @foreach(\Workable\Candidate\Enum\CandidateEnum::SOURCE as $key => $item)
                    <option value="{{ $key }}" {{ request('source') === (string)$key ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
            </button>
            <a href="{{ route('get.report_cv.amount') }}" class="btn btn-default">Làm mới</a>
        </div>
    </form>
</div>
