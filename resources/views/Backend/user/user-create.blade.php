@extends('Backend.layouts.app')

@section('title','Admin User-Create')
@section('styles')
<style>
#select-role{
    text-transform: capitalize;
    padding: 10px;
}

</style>
@endsection

@php
    $usr = Auth::guard('admin')->user();
@endphp

@section('page-title')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{__('User Create')}}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ $usr->can('dashboard.view') || $usr->can('dashboard.edit') ? route('admin.dashboard') : ''}}">Home</a></li>
                    <li><span>User Create</span></li>
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
                        <h4 class="header-title">User Create</h4>
                        <form method="POST" action="{{route('admin.user.store')}}">
                            @csrf
                            <div class=" form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputname">User Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputname" name="name" placeholder="Enter User Name"  autocomplete="name" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail">User Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" name="email" placeholder="Enter User Email" required autocomplete="email">
                                </div>
                            </div>
                            <div class=" form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter User Password" required autocomplete="new-password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password-confirm"> Confirm Password</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Enter User Confirm Password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="select-role" class="col-form-label">Select</label>
                                    <select id="select-role" name="role" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($roles as $row)
                                        <option value="{{$row->name}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone"> Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter User Phone Number" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label">Address</label>
                                    <input class="form-control" type="text" name="address">
                                </div>
                            </div>
                            {{-- errors list --}}
                            {{-- <div class="form-row">
                                <div class="form-group col-md-6">
                                    @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- basic form end -->
        </div>
    </div>
</div>


@endsection


@section('scripts')

@endsection
