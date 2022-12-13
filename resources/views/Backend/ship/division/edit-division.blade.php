@extends('Backend.layouts.app')

@section('title','Shipping')
@section('styles')

@endsection

@section('page-title')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{__('Admin Dashboard')}}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li><span>Shipping</span></li>
                </ul>
            </div>
        </div>
        @include('Backend.partials.logout-page')
    </div>
</div>

@endsection

@section('content')
<div class="row">
    <!-- data table start -->
    <div class="col-md-8 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Edit Division</h4>
                <div class="data-tables">
                    <form method="post" action="{{route('admin.shipping.update',$divisions->id)}}" >
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="division_name">Division Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('division_name') is-invalid @enderror" id="division_name" name="division_name" value="{{ $divisions->division_name }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->
</div>

@endsection

@section('scripts')


@endsection
