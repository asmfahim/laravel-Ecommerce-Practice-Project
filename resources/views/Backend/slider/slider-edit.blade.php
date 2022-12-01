@extends('Backend.layouts.app')

@section('title','Sliders')
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
                    <li><span>Dashboard</span></li>
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
                <h4 class="header-title">Edit Sliders</h4>
                <div class="data-tables">
                    <form method="post" action="{{route('admin.slider.update',$brand->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                        <label for="brand_name">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('brand_name_en') is-invalid @enderror" id="brand_name_en" name="brand_name_en" value="{{$brand->brand_name_en}}">
                        </div>
                        <div class="form-group">
                        <label for="brand_image">Brand Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('brand_image') is-invalid @enderror" id="brand_image" name="brand_image">
                        </div>
                        <div class="form-group">
                            <img src="{{asset('public/upload/brand/'. $brand->brand_image)}}" id="showImage" height="100" width="100" style="border-radius: 5px;" alt="">
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

<script>
    $(document).ready(function(){
        $('#brand_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
