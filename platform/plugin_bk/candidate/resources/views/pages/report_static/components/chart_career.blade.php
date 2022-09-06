<div class="col-md-12 js-report" style="margin-bottom: 100px" id="report-career">
    <div class="panel row" style="margin: 0">
        <div class="col-md-10" style="padding: 0">
            <div class="panel-body">
                <h3 style="margin-bottom: 0; margin-top: 0; font-size: 22px" class="pull-left">Nhóm ngành nghề</h3>
                <div id="report-chart-career">
                </div>
            </div>
        </div>
        <div class="col-md-2 list-career-content">
            <div class="panel-body">
                <div class="search-career">
                    <div class="form-group" style="margin-right: 15px; margin-bottom: 10px">
                        <input type="text" class="form-control js-search-career" placeholder="Chọn ngành nghề" autocomplete="off">
                    </div>
                    <div class="pull-right" style="margin-right: 15px">
                        <a href="javascript:void(0)" id="reset-career-chart">Reset All</a>
                    </div>
                </div>
                <div style="clear: both"></div>
                <div class="list-career">
                    @foreach($careers as $key => $career)
                        <label>
                            <input type="checkbox" class="js-career-check" name="career_id[]" value="{{ $career->id }}" {{ in_array($career->id, $top_careers) ? 'checked' : '' }}>
                            {{ $career->ca_name }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both"></div>
</div>