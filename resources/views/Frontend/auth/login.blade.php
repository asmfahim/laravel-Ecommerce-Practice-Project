@extends('Frontend.layouts.app')
@section('title','LOGIN REGISTER')

@section('style')
<style>
    .login {
    background: #157ED2;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-top: 2em;
}
.login-item{
    color: #ffffff;
}
</style>
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <h3 class="text-center gray">Login/Register Form</h3>
            <ul class="row nav nav-tabs text-center">
                <li class="nav-item col-md-6 active"><a class="nav-link" data-toggle="pill" href="#login">Login Form</a></li>
                <li class="nav-item col-md-6"><a class="nav-link" data-toggle="pill" href="#menu1">Register Form</a></li>
              </ul>

              <div class="tab-content">
                <div id="login" class="tab-pane fade in active pb-md-2">
                    <div class="col-md-6 col-sm-6 sign-in">
                        <div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                            <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div>
                        <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input @error('password') is-invalid @enderror" id="exampleInputPassword1" name="password" required autocomplete="current-password">
                            </div>
                            <div class="radio outer-xs">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-6 login " style="min-height: 50vh">
                        <div class=" text-center login-item  " style="width:100%;  ">
                            <h1>Login Form</h1>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade pb-md-2">
                    <div class="col-md-6 col-sm-6 login  " style="min-height: 80vh">
                        <div class="child-div text-center login-item  " style="width:100%; height:20px; ">
                            <h1>Register Form</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input @error('name') is-invalid @enderror" id="exampleInputName" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">User Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input @error('username') is-invalid @enderror" id="exampleInputName" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input  @error('email') is-invalid @enderror" id="exampleInputEmail2" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPhone">Phone Number <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input @error('password') is-invalid @enderror" id="exampleInputPhone" name="phone_number" value="{{ old('email') }}" required autocomplete="phone_number">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword">Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input @error('password') is-invalid @enderror" id="exampleInputPassword" name="password" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Confirm Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                        </form>


                    </div>
                </div>

              </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('Frontend.partials.brands')
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection

@section('script')

@endsection
