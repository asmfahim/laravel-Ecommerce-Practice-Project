@extends('Backend.layouts.app')

@section('title','Admin User Profile')
@section('styles')
    @include('Backend.profile.style')
@endsection

@php
    $usr = Auth::guard('admin')->user();
@endphp

@section('page-title')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Profile</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ $usr->can('dashboard.view') || $usr->can('dashboard.edit') ? route('admin.dashboard') : ''}}">Home</a></li>
                    <li><span>Profile</span></li>
                </ul>
            </div>
        </div>
        @include('Backend.partials.logout-page')
    </div>
</div>

@endsection

@section('content')

<div class="row">
    <div class="col-lg-6 col-ml-12">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Profile Edit</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="{{(!empty($admin->profile_photo_path)) ? url('public/upload/admin_images/'.$admin->profile_photo_path) : url('public/upload/no_photo.png')}}" alt=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                            <h5>
                                                {{$admin->name}}
                                            </h5>
                                            <h6>
                                                Web Developer and Designer
                                            </h6>
                                            <p class="proile-rating"></p>
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit Profile</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                                                </li>
                                            </ul>
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <a href="{{route('admin.profile.index')}}" class="btn btn-primary profile-edit-btn p-1">View Profile </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-work">
                                    <p>WORK LINK</p>
                                    <a href="">Website Link</a><br/>
                                    <a href="">Bootsnipp Profile</a><br/>
                                    <a href="">Bootply Profile</a>
                                    <p>SKILLS</p>
                                    <a href="">Web Designer</a><br/>
                                    <a href="">Web Developer</a><br/>
                                    <a href="">WordPress</a><br/>
                                    <a href="">WooCommerce</a><br/>
                                    <a href="">PHP, .Net</a><br/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <form method="POST" action="{{route('admin.profile.update',$admin->id)}}" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class=" form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputname">Profile Name</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputname" name="name" value="{{$admin->name}}"  autocomplete="name" autofocus>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail">Email Address</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" name="email" value="{{$admin->email}}"  required autocomplete="email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="phone1"> Phone Number</label>
                                                    <input type="text" class="form-control" id="phone1" name="phone" value="{{$admin->phone_number}}" placeholder="Enter Phone Number" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Address</label>
                                                    <input class="form-control" type="text" name="address" value="{{$admin->address}}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="Photo">Profile Photo</label>
                                                    <input type="file" class="form-control" id="Photo" name="profile_photo_path">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-form-label">Gender</label>
                                                    <select id="select-role" name="gender" class="form-control">
                                                        <option value="">Gender Select</option>
                                                        <option value="male" {{($admin->gender == 'male') ? 'selected' : ''}}>Male</option>
                                                        <option value="female" {{($admin->gender == 'female') ? 'selected' : ''}}>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <img src="{{(!empty($admin->profile_photo_path)) ? url('public/upload/admin_images/'.$admin->profile_photo_path) : url('public/upload/no_photo.png')}}" alt="" id="showImage" width="100" height="100">
                                                </div>
                                            </div>

                                            {{-- errors list --}}
                                            {{-- <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                </div>
                                            </div> --}}
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <form method="POST" action="{{route('admin.profile.change.password',$admin->id)}}" >
                                            @method('PUT')
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="oldPassword">Old Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="oldPassword" name="oldpassword" placeholder="Enter Old Password" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="newPassword">New Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" name="new_password" placeholder="Enter New Password"  autocomplete="new-password" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="col-form-label" for="password-confirm">Confirm Password</label>
                                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Enter Confirm Password" autocomplete="new-password" required>
                                                </div>
                                            </div>

                                            {{-- errors list --}}
                                            {{-- <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                </div>
                                            </div> --}}
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Change Password</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- basic form end -->
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        $('#Photo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
