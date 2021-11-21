@extends('Backend.layouts.app')

@section('title','Admin Role-Create')
@section('styles')
<style>
    .form-check-label {
        text-transform: capitalize;
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
                <h4 class="page-title pull-left">{{__('Role Create')}}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ $usr->can('dashboard.view') || $usr->can('dashboard.edit') ? route('admin.dashboard') : ''}}">Home</a></li>
                    <li><span>Permission Create</span></li>
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
                        <h4 class="header-title">Permission Create</h4>
                        <form method="POST" action="{{route('admin.permission.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="Inputname">Permission Group Name</label>
                                <input type="text" class="form-control" id="myInput"   name="group_name">
                            </div>
                            <div class="form-group">
                                <label for="name">Check Permissions</label>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkPermission1" name="checkPermissions[]" value="">
                                    <label class="form-check-label" for="checkPermission1"></label><br>
                                    <input type="checkbox" class="form-check-input" id="checkPermission2" name="checkPermissions[]" value="">
                                    <label class="form-check-label" for="checkPermission2"></label><br>
                                    <input type="checkbox" class="form-check-input" id="checkPermission3" name="checkPermissions[]" value="">
                                    <label class="form-check-label" for="checkPermission3"></label><br>
                                    <input type="checkbox" class="form-check-input" id="checkPermission4" name="checkPermissions[]" value="">
                                    <label class="form-check-label" for="checkPermission4"></label><br>
                                </div>
                                <p id="demo"></p>
                            </div>


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
