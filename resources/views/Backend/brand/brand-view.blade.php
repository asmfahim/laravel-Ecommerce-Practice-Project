@extends('Backend.layouts.app')

@section('title','BRANDS')
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
    <div class="col-md-8 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Brands Name</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Sl. No</th>
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Auth::guard('admin')->user()->can('brand.view'))

                            @foreach ($brands as  $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->brand_name_en}}</td>
                                <td><img src="{{asset('public/upload/brand/'.$row->brand_image)}}" alt="" style="width: 70px; height:60px; border-radius:5px;"></td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        @if (Auth::guard('admin')->user()->can('brand.edit'))
                                            <li class="mr-2 h5"><a href="{{route('admin.brand.edit',$row->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                        @endif
                                        @if (Auth::guard('admin')->user()->can('brand.delete'))
                                            <li class="h5">
                                                <a href="{{route('admin.brand.destroy',$row->id)}}" class="text-danger" onclick="show_confirm('delete-form-{{$row->id}}')">
                                                    <i class="ti-trash"></i>
                                                </a>

                                                <form id="delete-form-{{ $row->id }}" action="{{ route('admin.brand.destroy', $row->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </li>
                                        @endif

                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-5">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h4 class="header-title">Add Brand</h4>
                @if (Auth::guard('admin')->user()->can('brand.create'))

                <div class="data-tables">
                    <form method="post" action="{{route('admin.brand.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="brand_name">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('brand_name_en') is-invalid @enderror" id="brand_name_en" name="brand_name_en" placeholder="Brand Name">
                        </div>
                        <div class="form-group">
                        <label for="brand_image">Brand Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('brand_image') is-invalid @enderror" id="brand_image" name="brand_image">
                        </div>
                        <button type="submit" class="btn btn-primary">Add New</button>
                    </form>
                </div>
                @endif
            </div>
        </div>

    </div>
    <!-- data table end -->
</div>

@endsection

@section('scripts')
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
