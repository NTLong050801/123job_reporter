<div class="form-search pull-left fFilterC">
    <form action="{{ route('get.report_cv.list') }}" method="get" class="form-inline">
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
            <select name="career" class="form-control select2" id="career">
                <option value="">-- Nghề nghiệp --</option>
                @foreach($careers as $career)
                    <option value="{{ $career->id }}"
                        {{ ((array_get($query, 'career')== $career->id &&
                        array_get($query, 'career') !== null) ? 'selected=selected' : '' ) }}
                    >{{ $career->ca_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="rank" class="form-control select2" id="level">
                <option value="">-- Cấp bậc cao nhất --</option>
                @foreach($ranks as $rank)
                    <option value="{{ $rank->rank_id }}"
                        {{ ((array_get($query, 'rank')== $rank->rank_id &&
                        array_get($query, 'rank') !== null) ? 'selected=selected' : '' ) }}
                    >{{ $rank->rank_text }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="degree" class="form-control select2" id="education">
                <option value="">-- Trình độ học vấn --</option>
                @foreach($degrees as $degree)
                    <option value="{{ $degree->degree_id }}"
                        {{ ((array_get($query, 'degree')== $degree->degree_id &&
                        array_get($query, 'degree') !== null) ? 'selected=selected' : '' ) }}
                    >{{ $degree->degree_text }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
            </button>
            <a href="{{ route('get.report_cv.list') }}" class="btn btn-default">Làm mới</a>
        </div>
    </form>
</div>
