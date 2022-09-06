@unless ($breadcrumbs->isEmpty())
    @php
        $iconEdit = 'fa-pencil';
        $iconList = 'fa-list';
    @endphp
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @php
                $icon = icon_breadcrumb($breadcrumb->title);
            @endphp

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">
                    {!! $icon !!} 
                    {{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">
                    {!! $icon !!} 
                    {{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>
@endunless
