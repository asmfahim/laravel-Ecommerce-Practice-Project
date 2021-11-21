@extends('Backend.auth.login-app')

@section('title','Admin-Panel Confirm Password')

@section('login-content')
<div class="col-lg-6 col-md-8 login-box">
    <div class="col-lg-12 login-key">
        <i class="fa fa-key" aria-hidden="true"></i>
    </div>
    <div class="col-lg-12 login-title">
        {{ __('Admin Confirm Password') }}
    </div>

    <div class="col-lg-12 login-form">
        <div class="col-lg-12 login-form login-text">
            <div class="pb-2">{{ __('Please confirm your password before continuing.') }}</div>
            <form method="POST" action="{{ route('admin.password.confirm') }}">
                @csrf
                <div class="form-group">
                    <label for="password" class="form-control-label">{{ __('Password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" i>
                </div>
                <div class="form-group loginbttm row">
                    <div class="col-lg-6  login-text">
                        <!-- Error Message -->
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-6  login-button">
                        <div></div>
                        <button type="submit" class="btn btn-outline-primary">{{ __('Confirm Password') }}</button>
                    </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <div class="form-group">
                        @if (Route::has('admin.password.request'))
                            <a class="btn btn-link login-text" href="{{ route('admin.password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3 col-md-2"></div>
</div>
@endsection




{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('admin.password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
