@extends('Backend.layouts.app')

@section('title','BRANDS')
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
                <h4 class="header-title">Edit Category</h4>
                <div class="data-tables">
                    <form method="post" action="{{route('admin.category.update',$category->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                        <label for="category_name_en">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('category_name_en') is-invalid @enderror" id="category_name_en" name="category_name_en" value="{{$category->category_name_en}}">
                        </div>
                        <div class="form-group">
                        <label for="category_icon">Category Icon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('category_icon') is-invalid @enderror" id="category_icon" name="category_icon" value="{{$category->category_icon}}">
                        </div>
                        <div class="form-group">
                            <span style="font-size:20px"><i class="{{$category->category_icon}}"></i></span>
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
