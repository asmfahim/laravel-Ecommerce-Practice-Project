@extends('Backend.layouts.app')

@section('title','Coupon')
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
                <h4 class="header-title">Coupon Items</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Coupon Name </th>
								<th>Coupon Discount</th>
								<th>Validity </th>
								<th>Status </th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Auth::guard('admin')->user()->can('coupon.view'))

                                @foreach ($coupons as  $row)
                                    <tr>
                                        <td> {{ $row->coupon_name }}  </td>
                                        <td> {{ $row->coupon_discount }}% </td>
                                        <td width="25%"> {{ Carbon\Carbon::parse($row->coupon_validity)->format('D, d F Y') }}</td>

                                        <td>
                                            @if($row->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                <span class="badge badge-pill badge-success"> Valid </span>
                                            @else
                                                <span class="badge badge-pill badge-danger"> Invalid </span>
                                            @endif

                                        </td>

                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                @if (Auth::guard('admin')->user()->can('coupon.edit'))

                                                    <li class="mr-2 h5"><a href="{{route('admin.coupon.edit',$row->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                @endif
                                                @if (Auth::guard('admin')->user()->can('coupon.delete'))
                                                    <li class="h5">
                                                        <a href="{{route('admin.coupon.destroy',$row->id)}}" class="text-danger" onclick="show_confirm('delete-form-{{$row->id}}')">
                                                            <i class="ti-trash"></i>
                                                        </a>

                                                        <form id="delete-form-{{ $row->id }}" action="{{ route('admin.coupon.destroy', $row->id) }}" method="POST" style="display: none;">
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
                <h4 class="header-title">Add Coupon</h4>
                @if (Auth::guard('admin')->user()->can('coupon.create'))

                <div class="data-tables">
                    <form method="post" action="{{route('admin.coupon.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="coupon_name">Coupon Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name" name="coupon_name" placeholder="coupon Name">
                        </div>
                        <div class="form-group">
                            <label for="coupon_discount">Coupon Discount(%) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('coupon_discount') is-invalid @enderror" id="coupon_discount" name="coupon_discount" placeholder="coupon discount(%)">
                        </div>
                        <div class="form-group">
                        <label for="coupon_validity">Coupon Validity Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('coupon_validity') is-invalid @enderror" id="coupon_validity" name="coupon_validity" placeholder="Category Icon " min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
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
