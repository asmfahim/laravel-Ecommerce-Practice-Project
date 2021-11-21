@php
    $admin = Auth::guard('admin')->user();
@endphp

<div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        <a href="{{route('admin.profile.index')}}">
            <img class="avatar user-thumb" src="{{(!empty($admin->profile_photo_path)) ? url('public/upload/admin_images/'.$admin->profile_photo_path) : url('public/upload/no_photo.png')}}" alt="avatar">
        </a>
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ $admin->name }} <i
                class="fa fa-angle-down"></i></h4>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Message</a>
            @if ($admin->can('profile.view') || $admin->can('profile.edit'))
                <a class="dropdown-item" href="{{route('admin.profile.index')}}">Profile</a>
            @endif

            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Log Out</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
            class="d-none">
            @csrf
            </form>
        </div>
    </div>
</div>
