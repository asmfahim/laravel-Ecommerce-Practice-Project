@extends('Backend.auth.login-app')

@section('title','Admin-Panel Reset Password')

@section('login-content')
<div class="col-lg-6 col-md-8 login-box">
    <div class="col-lg-12 login-key">
        <i class="fa fa-key" aria-hidden="true"></i>
    </div>
    <div class="col-lg-12 login-title">
        {{ __('Admin Reset Password') }}
    </div>

    <div class="col-lg-12 login-form">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-lg-12 login-form">
            <form method="POST" action="{{ route('admin.password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-control-label">{{ __('E-Mail Address') }}</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="email">
                </div>
                <div class="form-group loginbttm row">
                    <div class="col-lg-6  login-text">
                        <!-- Error Message -->
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-6  login-button">
                        <div></div>
                        <button type="submit" class="btn btn-outline-primary">{{ __('Send Password Reset Link') }}</button>
                    </div>
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
                <div class="card-header">{{ __('Admin Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
