<option value="">-- Chọn menu cấp cha -- </option>
@foreach($items as $menu)
    @php
        $selected = old('parent_id', $menu_id ?? 0) == $menu['id'] ? 'selected' : '';
    @endphp
    <option {{ $selected }} value="{{ $menu['id'] }}">
        @for($i=0; $i < $menu['level']; $i++)---@endfor
        {{ $menu['title'] }}
    </option>
@endforeach
