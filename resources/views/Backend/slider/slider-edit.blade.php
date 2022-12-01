@extends('Backend.layouts.app')

@section('title','SLIDERS')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
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
    <div class="col-md-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Slider Update </h4>
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h4 class="header-title">Edit Slider</h4>
                        @if (Auth::guard('admin')->user()->can('slider.edit'))

                        <div class="data-tables">
                            <form method="post" action="{{route('admin.slider.update',$slider->id)}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                <label for="slider_title">Slider Title <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @error('slider_title') is-invalid @enderror" value="{{$slider->slider_title}}" id="slider_title" name="slider_title" placeholder="Slider Title">
                                </div>
                                <div class="form-group">
                                    <label for="slider_description">Description <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control @error('slider_title') is-invalid @enderror" id="slider_description" name="slider_description" value="{{$slider->slider_description}}" placeholder="Description">
                                    </div>
                                <div class="form-group">
                                <label for="slider_img">Slider Image <span class="text-danger"> *</span></label>
                                <input type="file" class="form-control @error('slider_img') is-invalid @enderror" id="slider_img" name="slider_img">
                                </div>
                                <div class="form-group">
                                    <label for="slider_preview">Slider Image Preview </label>
                                        <img src="{{asset('public/upload/sliders/'.$slider->slider_img)}}" style="display: block" id="slider_preview" alt="" width="150" height="150" >
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->
</div>

@endsection

@section('scripts')
{{-- Image Preview --}}

<script type="text/javascript">
    $(document).ready(function(){
    $('#slider_img').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
           $('#slider_preview').attr('src',e.target.result).width(150).height(150);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>

<script>
    function show_confirm(id){
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: 'If you delete this, it will be gone forever.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            document.getElementById(id).submit();
            }
        });
    }
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
@endsection
