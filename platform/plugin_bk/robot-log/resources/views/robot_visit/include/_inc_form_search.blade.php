<div class="form-search pull-left fFilterC">
    <form action="" method="get"
          class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" name="date_range" autocomplete="off"
                   placeholder="Chọn thời gian" value="{{ form_query('date_range', $query) }}">
        </div>
        <div class="form-group">
            <select class="form-control" name="bot">
                <option value="">-- Chọn loại bot --</option>
                @foreach(config('plugins.robot-log.robot_counter.list_bot') ?? [] as $bot)
                    <option value="{{ $bot }}" {{ query_selected('bot', $bot) }}>{{ $bot }}</option>
                @endforeach
            </select>
        </div>
        @php $config = config('plugins.google-log.config') @endphp
        <div class="form-group">
            <select class="form-control" name="label_page">
                <option value="">-- Chọn label page --</option>
                @foreach($config['page'] as $label => $paths)
                    <option value="{{ $label }}" {{ query_selected('label_page', $label) }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="path">
                <option value="">-- Chọn path page --</option>
                @foreach($config['page'] as $label => $paths)
                    @foreach($paths as $path)
                        <option value="{{ $path }}" data-parent="{{ $label }}"
                                {{ query_selected('path', $path) }}>
                            {{ $path }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="app_int">
                <option value="">-- Chọn app --</option>
                @foreach($config['app'] as $key => $app)
                    <option value="{{ $key }}" {{ query_selected('app_int', $key, 1) }}>App {{ $app }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Lọc
            </button>
            <a href="{{ url()->current() }}" class="btn btn-default">Làm
                mới</a>
        </div>
    </form>
</div>