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
                <h4 class="header-title">Edit State</h4>
                <div class="data-tables">
                    <form method="post" action="{{route('admin.shipping.state.update',$state->id)}}" >
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="division_name">Division Name <span class="text-danger">*</span></label>
                            <select name="division_id" id="division_name" class="form-control @error('division_name') is-invalid @enderror"  >
                                <option value="" selected="" disabled="">Select Division</option>
                                @foreach($division as $div)
                                <option value="{{ $div->id }}" {{ $div->id == $district->division_id ? 'selected': '' }} >{{ $div->division_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district_name">District Name <span class="text-danger">*</span></label>
                            <select name="district_id" id="district_name" class="form-control @error('district_name') is-invalid @enderror"  >
                                <option value="" selected="" disabled="">Select District</option>
                                @foreach($district as $div)
                                <option value="{{ $div->id }}" {{ $div->id == $district->district_id ? 'selected': '' }} >{{ $div->district_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="state_name">State Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('state_name') is-invalid @enderror" id="state_name" name="state_name" value="{{ $state->state_name }}">
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
