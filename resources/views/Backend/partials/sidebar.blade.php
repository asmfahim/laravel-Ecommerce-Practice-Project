
@php
 $usr = Auth::guard('admin')->user();
@endphp

<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ $usr->can('dashboard.view') || $usr->can('dashboard.edit') ? route('admin.dashboard') : ''}}"><img src="{{asset('public/Backend')}}/assets/images/logo/logo3.png" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    {{-- Dashboard --}}
                    @if ($usr->can('dashboard.view') || $usr->can('dashboard.edit'))
                    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif
                    {{-- admin user --}}
                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li class="{{Route::is('admin.user.index') || Route::is('admin.user.create') || Route::is('admin.user.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-user"></i><span>User
                            </span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('admin.user.index') || Route::is("admin.user.edit") ? 'active' : "" }}"><a href="{{route('admin.user.index')}}">User List</a></li>
                            <li class="{{Route::is('admin.user.create') ? 'active' : ''}}"><a href="{{route('admin.user.create')}}">User Create</a></li>
                            <li><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>
                        </ul>
                    </li>
                    @endif

                    {{-- Role Permisson Menu --}}
                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete') || $usr->can('permission.create'))
                    <li class="{{Route::is('admin.roles.index') || Route::is('admin.roles.create')||Route::is('admin.permission.create') || Route::is('admin.roles.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="fa fa-lock"></i><span>Roles & Permissions
                            </span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'active' : ''}}"><a href="{{route("admin.roles.index")}}">Roles List</a></li>
                            <li class="{{Route::is('admin.roles.create') ? 'active' : ''}}"><a href="{{route("admin.roles.create")}}">Roles Create</a></li>
                            <li class="{{Route::is('admin.permission.create') ? 'active' : ''}}"><a href="{{route("admin.permission.create")}}">Permission Create</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('brand.create') || $usr->can('brand.view') ||  $usr->can('brand.edit') ||  $usr->can('brand.delete'))

                    <li class="{{Route::is('admin.brand.index') | Route::is('admin.brand.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-layout-sidebar-left"></i><span>Brands
                            </span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('admin.brand.index') | Route::is('admin.brand.edit') ? 'active' : ''}}"><a href="{{route('admin.brand.index')}}">All Brand</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('category.create') || $usr->can('category.view') ||  $usr->can('category.edit') ||  $usr->can('category.delete'))

                    <li class="{{Route::is('admin.category.index') | Route::is('admin.category.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-layout-sidebar-left"></i><span>Categorys
                            </span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('admin.category.index') | Route::is('admin.category.edit') ? 'active' : ''}}"><a href="{{route('admin.category.index')}}">All Brand</a></li>
                        </ul>
                    </li>
                    @endif

                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-layout-sidebar-left"></i><span>Sidebar
                                Types
                            </span></a>
                        <ul class="collapse">
                            <li><a href="index.html">Left Sidebar</a></li>
                            <li><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


