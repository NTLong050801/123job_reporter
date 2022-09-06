<div class="form-search pull-left fFilterC">
    <form action="{{ route('get.report_static.list_rank') }}" method="get" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" name="month_range" placeholder="Chọn tháng" value="{{ array_get($query, 'month_range') }}" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Lọc
            </button>
            <a href="{{ route('get.report_static.list_rank') }}" class="btn btn-default">Làm mới</a>
        </div>
    </form>
</div>
