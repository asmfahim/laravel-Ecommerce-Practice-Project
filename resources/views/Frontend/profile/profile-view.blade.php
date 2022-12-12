@extends('Frontend.layouts.app')
@section('title','PROFILE VIEW')

@section('styles')
    @include('Frontend.profile.style')
@endsection



@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Profile</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Profile</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img src="{{(!empty($user->profile_photo_path)) ? url('public/upload/user_images/'.$user->profile_photo_path) : url('public/upload/no_photo.png')}}" alt="" style="width: 170px; height:170px;border-radius:5px;"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head ">
                                        <h5>
                                            <strong>{{ucwords($user->name)}}</strong>
                                        </h5>
                                        <h6>
                                            <i style="color:tomato; font-size:14px">{{ucwords($user->username)}}</i>
                                        </h6>
                                        <p class="proile-rating"> <span></span></p>
                                <ul class="nav nav-tabs" >
                                    <li class="nav-item">
                                        <a class="nav-link active">About</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2" >
                            <a href="{{route('profile.edit')}}" class="btn btn-primary profile-edit-btn p-1"> Edit Profile </a>
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
                                {{-- logout --}}
                                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a><form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <br/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-primary">{{ucwords($user->username)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-primary">{{ucwords($user->name)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-primary">{{ucwords($user->email)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Gender</label>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-primary" style="text-transform: capitalize;">{{$user->gender}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-primary">{{$user->phone_number}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-primary">{{ucwords($user->address)}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('Frontend.partials.brands')
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
