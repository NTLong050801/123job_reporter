<div class="form-filter pull-left">
    <form action="{{$action}}" method="get" class="form-inline form-filter-report">
        <div class="">
            <select class="form-control" name="day" id="">
                <option value="">--Ngày--</option>
                <option value="28" {{ form_query('day', $request) == 28 ? 'selected' : '' }}>28</option>
                <option value="14" {{ form_query('day', $request) == 14 ? 'selected' : '' }}>14</option>
                <option value="7" {{ form_query('day', $request) == 7 ? 'selected' : '' }}>7</option>
            </select>
        </div>
        <div class="" style="margin: 0 5px">
            <select class="form-control" name="continent" id="">
                <option value="">--Châu lục--</option>
                @foreach($continents as $key=> $continent)
                    <option
                        value="{{$continent['slug']}}" {{ query_selected('continent', $key) }}>{{$continent['name']}}</option>
                @endforeach
            </select>
        </div>

        <input placeholder="Tên quốc gia" class="form-control" name="site_name"
               value="{{form_query('site_name', $request)}}" type="text">
        <button style="margin-left: 20px;box-sizing: border-box " type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-search"></i> Lọc
        </button>
        <a style="margin-left:  5px" href="{{$action}}" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</a>
    </form>

</div>
