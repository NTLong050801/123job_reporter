@inject('adminMenu','Workable\Acl\Services\PermissionService')
@php
    $modules = $adminMenu->getListMenu();
    $uri   = request()->getRequestUri();
    $uriArr = explode("/", ltrim($uri, "/"));
    $stringUri = implode("/", $uriArr);

    $uriArrSplice = array_splice($uriArr, 0, 2);
    $uriArrSplice = implode("/", $uriArrSplice);
@endphp

@if ($modules)
    <section class="sidebar style-scroll" style="overflow-y: auto;">
        <ul class="sidebar-menu tree scroll-sidebar" style="height: 90vh" data-widget="tree" id="sidebar-menu">
            @foreach($modules[0] ??[] as $key => $item)
                @php
                    $hasChild = $item['has_child'] ?? 0;
                    $checkUri = $uriArrSplice;
                    if (!$hasChild)
                    {
                        $uriArrSub = substr( $stringUri, 0, strlen(ltrim($item['uri'], "/")) );
                        $checkUri = $uriArrSub;
                    }

                    $subMenu  = $modules[$key] ?? [] ;
                    $open     = $checkUri == ltrim($item['uri'], "/") ? 'active menu-open' : '';
                @endphp

                <li class="li-parent placeholder li1 {{ $hasChild ? 'treeview ' . $open : '' }}" id="{{$item['id']}}">
                    <a href="{{ $hasChild ? '#' : $item['uri'] }}" data-href="{{ $item['uri'] }}"
                        {!! $open ? 'style="font-weight: 600 !important; color: #000"' : '' !!} >
                        <span>{{ $item['title'] }}</span>
                        @if ($hasChild)
                            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        @endif
                    </a>

                    @if ($item['has_child'])
                        <ul class="treeview-menu active">
                            @foreach($subMenu as $menuItem)
                                @php
                                    $path = '/'.request()->path();
                                    $openSub = $path == $menuItem['uri'] ? 'active' : '';
                                @endphp
                                <li class="{{ $openSub }}">
                                    <a href="{{ $menuItem['uri'] }}">
                                        <i class="{{ $menuItem['icon'] }}"></i>
                                        {{ $menuItem['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
@endif
