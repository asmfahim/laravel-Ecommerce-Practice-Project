@extends('Backend.auth.login-app')

@section('title','Admin | Verify Email Address')


@section('login-content')

<div class="col-lg-6 col-md-8 login-box">
    <div class="col-lg-12 login-key">
        <i class="fa fa-key" aria-hidden="true"></i>
    </div>
    <div class="col-lg-12 login-title">
        ADMIN PANEL
        <div>{{ __('Verify Your Email Address') }}</div>
    </div>

    <div class="col-lg-12 login-form">
        <div class="col-lg-12 login-form login-text">

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf

                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
    <div class="col-lg-3 col-md-2"></div>
</div>

@endsection



{{--
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
