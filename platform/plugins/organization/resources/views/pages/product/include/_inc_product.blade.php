<option value="">- Sản phẩm -</option>
@foreach($items as $item)
    @php $selected = ($item->id == $parent_id) ? 'selected': '' @endphp
    <option {{ $selected }} value="{{ $item->id }}">
        @for($i=0; $i < $item->level; $i++)---@endfor
        {{ $item->name }}
    </option>
@endforeach
