@if($paginator->lastPage() > 1)
    <ul class="pagination pagination-sm no-margin pull-right">
        @if($paginator->currentPage() != 1)
            <li><a href="{{$paginator->previousPageUrl()}}"><i class="fa fa-angle-left"></i></a></li>
        @endif
        @for($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{$paginator->currentPage() == $i?'active':''}}"><a href="{{$paginator->url($i)}}">{{$i}}</a>
            </li>
        @endfor
        @if($paginator->currentPage() != $paginator->lastPage())
            <li><a href="{{$paginator->nextPageUrl()}}"><i class="fa fa-angle-right"></i></a></li>
        @endif
    </ul>
@endif