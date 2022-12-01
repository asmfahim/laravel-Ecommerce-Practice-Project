@extends('Backend.layouts.app')

@section('title','Product List')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

@php
    $usr = Auth::guard('admin')->user();
@endphp

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
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Product Lists</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Discount</th>
                                <th>Quantity</th>
                                <th>Product Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Auth::guard('admin')->user()->can('product.view'))

                            @foreach ($products as  $row)
                            <tr>
                                <td><img src="{{asset('public/upload/products/thambnail/'.$row->product_thambnail)}}" style="border-radius:5px; width: 60px; height:50px" alt=""></td>
                                <td>{{$row->product_name_en}}</td>
                                <td>{{$row->selling_price . ' ' }} ৳</td>
                                <td>
                                    @if ($row->discount_price == NULL)
                                    <span class="badge badge-pill badge-danger">No Discount</span>
                                    @else
                                    @php
                                        $amount = $row->selling_price - $row->discount_price;
                                        $discount = ($amount/$row->selling_price) * 100;
                                    @endphp
                                    <span class="badge badge-pill badge-danger">{{round($discount) .' ' }} %</span>
                                    @endif
                                </td>
                                <td>{{$row->product_qty . ' '}}Pic</td>
                                <td>
                                    @if ($row->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        @if (Auth::guard('admin')->user()->can('product.edit'))

                                            <li class="mr-2 h5"><a href="{{route('admin.product.edit',$row->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                        @endif
                                        @if (Auth::guard('admin')->user()->can('product.delete'))
                                            <li class="mr-2 h5">
                                                <a href="{{route('admin.product.destroy',$row->id)}}" class="text-danger" onclick="show_confirm('delete-form-{{$row->id}}')">
                                                    <i class="ti-trash"></i>
                                                </a>

                                                <form id="delete-form-{{ $row->id }}" action="{{ route('admin.product.destroy', $row->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </li>
                                        @endif

                                        @if ($row->status == 1)
                                        <li class=" h5"><a href="{{route('admin.product.inactive',$row->id)}}" class="text-danger"><i class="fa fa-arrow-down"></i></a></li>
                                        @else
                                        <li class=" h5"><a href="{{route('admin.product.active',$row->id)}}" class="text-success"><i class="fa fa-arrow-up"></i></a></li>
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
    <!-- data table end -->
</div>

@endsection

@section('scripts')
<script>
    function show_confirm(id){
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure, you want to delete this record?',
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
