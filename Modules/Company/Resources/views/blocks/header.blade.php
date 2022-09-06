@inject('menu','Modules\Company\Services\MenuService')
@php

    $menus= $menu->getListMenuVisible();
//    $menus = [1,2,3];
//    $menus = $menus[0];
@endphp
<header class="main-header">
    <!-- Logo ko có data-->
    <a href="/" target="_blank" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Reporter</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b style="font-weight: 500">System</b>Reporter</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-main">
            @php
                $uri = request()->segments()[0] ?? '/company';

            @endphp
            <ul class="nav navbar-nav">
                @foreach($menus as $item)
                    {{-- {{dump($item)}} --}}
                    @php
                        $active = \Illuminate\Support\Str::contains($uri, $item->menu_slug) ? 'active' : '';
                    @endphp
                    <li class="user user-menu {{ $active }}">
                        @php
                        //
                        if(strlen($item->menu_link) > 0){
                            if(can($item->menu_route_name)){
                                $url = $item->menu_link;
                            }
                            else{
                                $url = $item->menu_slug;
                            }
                        }
                        else{
                            // url giữ nguyên
                            $url = $item->menu_slug;
                        }
                        @endphp
                            <a href="{{config('company::config.prefix').'/'.ltrim($url, "/")}}">{{ $item->menu_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-plus"></i>
{{--                        <span class="label label-warning">10</span>--}}
                    </a>
                    <ul role="menu" class="dropdown-menu" style="padding: 10px 0">
                        <li>
                            <a href="/profile/index"> <i class="fa fa-user-circle"></i> <span class="text">Thông tin cá nhân</span>
                            </a>
                        </li>
                        <li>
                            <a href="/company/announcements/create"> <i class="fa fa-bell"></i> <span class="text">Tạo thông báo</span>
                            </a>
                        </li>
                        <li>
                            <a href="/hrm/employee/create"> <i class="fa fa-users"></i> <span class="text">Tạo tài khoản</span>
                            </a>
                        </li>
                        <li>
                            <a href="/product/posts/create"> <i class="fa fa-plus"></i> <span class="text">Tạo bài viết</span>
                            </a>
                        </li>
                        <li>
                            <a href="/product/topic/create"> <i class="fa fa-plus-square"></i> <span class="text">Tạo chủ đề</span>
                            </a>
                        </li>
                        <li>
                            <a href="/product/tags/index"> <i class="fa fa-hashtag"></i> <span class="text"> Tạo tag bài viết</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/images/logo/user_default_150x150.png" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ get_data_user('admins', 'name') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/profile/index">
                                <i class="fa fa-user"></i> <span class="text">Thông tin tài khoản
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('get.admin.logout')}}"> <i class="fa fa-power-off"></i>
                                <span class="text">Thoát</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
