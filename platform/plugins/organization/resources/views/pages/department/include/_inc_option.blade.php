<option value="">-- Phòng ban trực thuộc --</option>
@foreach($items as $menu)
    @php
        $selected = old_selected('parent_id', $query ?? [], $menu['id'])
    @endphp
    <option {{ $selected }} value="{{ $menu['id'] }}">
        @for($i=0; $i < $menu['level']; $i++)---@endfor
        {{ $menu['name'] }}
    </option>
@endforeach
