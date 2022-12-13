@extends('Backend.layouts.app')

@section('title','Coupon')
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
                    <li><span>Coupon</span></li>
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
                <h4 class="header-title">Edit Coupon</h4>
                <div class="data-tables">
                    <form method="post" action="{{route('admin.coupon.update',$coupons->id)}}" >
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="coupon_name">Coupon Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name" name="coupon_name" value="{{ $coupons->coupon_name }}">
                        </div>
                        <div class="form-group">
                            <label for="coupon_discount">Coupon Discount(%) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('coupon_discount') is-invalid @enderror" id="coupon_discount" name="coupon_discount" value="{{ $coupons->coupon_discount }}">
                        </div>
                        <div class="form-group">
                            <label for="coupon_validity">Coupon Validity Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('coupon_validity') is-invalid @enderror" id="coupon_validity" name="coupon_validity"  min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $coupons->coupon_validity }}">
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
