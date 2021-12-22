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
                                <img src="{{(!empty($user->profile_photo_path)) ? url('public/upload/user_images/'.$user->profile_photo_path) : url('public/upload/no_photo.png')}}" alt="" style="width: 50%; height:50%; border-radius:5px;"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head ">
                                <h5>
                                    <strong>{{$user->name}}</strong>
                                </h5>
                                <h6>
                                    <i style="color:tomato; font-size:14px">{{$user->username}}</i>
                                </h6>
                                <p class="proile-rating"> <span></span></p><br><br>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item active">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2" >
                            <a href="{{route('profile')}}" class="btn btn-primary profile-edit-btn p-1"> <i class="fa fa-angle-left"></i> Back</a>
                        </div>
                    </div><br>
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
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <form method="POST" action="{{route('profile.update',$user->id)}}" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class=" row">
                                            <div class="form-group col-md-10">
                                                <label for="exampleInputname">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputname" name="name" value="{{$user->name}}"  autocomplete="name" autofocus>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label for="exampleInputusername">User Name</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="exampleInputusername" name="username" value="{{$user->username}}"  autocomplete="username" autofocus>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label for="exampleInputEmail">Email Address</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" name="email" value="{{$user->email}}"  required autocomplete="email">
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label for="phone1"> Phone Number</label>
                                                <input type="text" class="form-control" id="phone1" name="phone" value="{{$user->phone_number}}" placeholder="Enter Phone Number" required>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label class="col-form-label">Address</label>
                                                <input class="form-control" type="text" name="address" value="{{$user->address}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label for="Photo">Profile Photo</label>
                                                <input type="file" class="form-control" id="Photo" name="profile_photo_path">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="col-form-label">Gender</label>
                                                <select id="select-role" name="gender" class="form-control">
                                                    <option value="">Gender Select</option>
                                                    <option value="male" {{($user->gender == 'male') ? 'selected' : ''}}>Male</option>
                                                    <option value="female" {{($user->gender == 'female') ? 'selected' : ''}}>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <img src="{{(!empty($user->profile_photo_path)) ? url('public/upload/user_images/'.$user->profile_photo_path) : url('public/upload/no_photo.png')}}" style="text-align:center;width:40%;height:40%; border-radius:5px" alt="" id="showImage" >
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
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- change password  --}}
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form method="POST" action="{{route('profile.change.password',$user->id)}}" >
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-10">
                                                <label for="oldPassword">Old Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="oldPassword" name="oldpassword" placeholder="Enter Old Password" required>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label for="newPassword">New Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" name="new_password" placeholder="Enter New Password"  autocomplete="new-password" required>
                                            </div>
                                            <div class="form-group col-md-10">
                                                <label class="col-form-label" for="password-confirm">Confirm Password</label>
                                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Enter Confirm Password" autocomplete="new-password" required>
                                            </div>
                                        </div>

                                        {{-- errors list
                                         <div class="form-row">
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
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Change Password</button>
                                        </div>
                                    </form>
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
