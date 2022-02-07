@extends('Backend.layouts.app')

@section('title','SUB-SUB-CATEGORY')
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
                <h4 class="header-title">Edit Sub Sub Category</h4>
                <div class="data-tables">
                    <form method="post" action="{{route('admin.subsubcategory.update',$subsubcategory->id)}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="category">Category<span class="text-danger">*</span> </label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category" name="category_id">
                              <option value="" >Select Category</option>
                              @foreach ($category as $row )
                              <option value="{{$row->id}}" {{($row->id == $subsubcategory->category_id) ? "selected" : " "}}>{{$row->category_name_en}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory">Sub Category<span class="text-danger">*</span> </label>
                            <select class="form-control @error('subcategory_id') is-invalid @enderror" id="subcategory" name="subcategory_id">
                              <option value="" >Select Sub Category</option>
                              @foreach ($subcategory as $row )
                              <option value="{{$row->id}}" {{($row->id == $subsubcategory->category_id) ? "selected" : " "}}>{{$row->subcategory_name_en}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="subsubcategory_name_en">Sub Sub Category  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('subsubcategory_name_en') is-invalid @enderror" id="subsubcategory_name_en" name="subsubcategory_name_en" value="{{$subsubcategory->subsubcategory_name_en}}">
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
