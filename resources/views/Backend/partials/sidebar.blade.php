
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
                                class="fa fa-list-ul"></i><span>Brands
                            </span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('admin.brand.index') | Route::is('admin.brand.edit') ? 'active' : ''}}"><a href="{{route('admin.brand.index')}}">All Brand</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('category.create') || $usr->can('category.view') ||  $usr->can('category.edit') ||  $usr->can('category.delete'))

                    <li class="{{Route::is('admin.category.index') | Route::is('admin.category.edit') | Route::is('admin.subcategory.index') | Route::is('admin.subcategory.edit') | Route::is('admin.subsubcategory.index') | Route::is('admin.subsubcategory.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="fa fa-list-ul"></i><span>Categorys
                            </span></a>
                        <ul class="collapse">

                            {{-- category --}}
                            @if ($usr->can('category.create') || $usr->can('category.view') ||  $usr->can('category.edit') ||  $usr->can('category.delete'))
                            <li class="{{Route::is('admin.category.index') | Route::is('admin.category.edit') ? 'active' : ''}}"><a href="{{route('admin.category.index')}}">All Category</a></li>
                            @endif

                            {{-- subcategory --}}
                            @if ($usr->can('subcategory.create') || $usr->can('subcategory.view') ||  $usr->can('subcategory.edit') ||  $usr->can('subcategory.delete'))
                            <li class="{{Route::is('admin.subcategory.index') | Route::is('admin.subcategory.edit') ? 'active' : ''}}"><a href="{{route('admin.subcategory.index')}}">All Sub-Category</a></li>
                            @endif

                            {{-- subsubcategory --}}
                            @if ($usr->can('subsubcategory.create') || $usr->can('subsubcategory.view') ||  $usr->can('subsubcategory.edit') ||  $usr->can('subsubcategory.delete'))
                            <li class="{{Route::is('admin.subsubcategory.index') | Route::is('admin.subsubcategory.edit') ? 'active' : ''}}"><a href="{{route('admin.subsubcategory.index')}}">All Sub-Sub-Category</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    {{-- product list --}}
                    <li class="{{Route::is('admin.product.index') | Route::is('admin.product.edit') | Route::is('admin.product.create') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="fa fa-product-hunt"></i><span>Products </span></a>
                        <ul class="collapse">

                            {{-- Manage Product  --}}
                            @if ( $usr->can('product.view') ||  $usr->can('product.edit') ||  $usr->can('product.delete'))
                            <li class="{{Route::is('admin.product.index') | Route::is('admin.product.edit') ? 'active' : ''}}"><a href="{{route('admin.product.index')}}">Manage Product</a></li>
                            @endif

                            {{-- Add Product  --}}
                            @if ($usr->can('product.create'))
                            <li class="{{Route::is('admin.product.create')  ? 'active' : ''}}"><a href="{{route('admin.product.create')}}">Add Product</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- Coupon part  --}}
                    @if ($usr->can('coupon.create') || $usr->can('coupon.view') ||  $usr->can('coupon.edit') ||  $usr->can('coupon.delete'))

                    <li class="{{Route::is('admin.coupon.index') | Route::is('admin.coupon.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="fa fa-list-ul"></i><span>Coupon
                            </span></a>
                        <ul class="collapse">
                            <li class="{{Route::is('admin.coupon.index') | Route::is('admin.coupon.edit') ? 'active' : ''}}"><a href="{{route('admin.coupon.index')}}">All Coupon</a></li>
                        </ul>
                    </li>
                    @endif

                    {{-- End coupon part  --}}

                    {{-- Sidebar --}}
                    <li class="{{Route::is('admin.slider.index') | Route::is('admin.slider.edit') | Route::is('admin.slider.create') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-layout-sidebar-left"></i><span>Slider </span></a>
                        <ul class="collapse">

                            {{-- Manage Product  --}}
                            @if ( $usr->can('slider.view') ||  $usr->can('slider.edit') ||  $usr->can('slider.delete'))
                            <li class="{{Route::is('admin.slider.index') | Route::is('admin.slider.edit') ? 'active' : ''}}"><a href="{{route('admin.slider.index')}}">Manage Slider</a></li>
                            @endif

                        </ul>
                    </li>


                    {{-- demo --}}
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


