@extends('Backend.layouts.app')

@section('title','Shipping')
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
                <h4 class="header-title">Shipping State</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Division Name </th>
								<th>District Name </th>
								<th>State Name </th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Auth::guard('admin')->user()->can('shipping.view'))

                                @foreach ($state as  $row)
                                    <tr>
                                        <td > {{ $row->division->division_name }} </td>
                                        <td > {{ $row->district->district_name }}  </td>
                                        <td > {{ $row->state_name }}  </td>

                                        <td width="40%">
                                            <ul class="d-flex justify-content-center">
                                                @if (Auth::guard('admin')->user()->can('shipping.edit'))

                                                    <li class="mr-2 h5"><a href="{{route('admin.shipping.state.edit',$row->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                @endif
                                                @if (Auth::guard('admin')->user()->can('shipping.delete'))
                                                    <li class="h5">
                                                        <a href="{{route('admin.shipping.state.destroy',$row->id)}}" class="text-danger" onclick="show_confirm('delete-form-{{$row->id}}')">
                                                            <i class="ti-trash"></i>
                                                        </a>

                                                        <form id="delete-form-{{ $row->id }}" action="{{ route('admin.shipping.state.destroy', $row->id) }}" method="POST" style="display: none;">
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
                <h4 class="header-title">Add State</h4>
                @if (Auth::guard('admin')->user()->can('shipping.create'))

                <div class="data-tables">
                    <form method="post" action="{{route('admin.shipping.state.store')}}" >
                        @csrf

                        <div class="form-group">
                        <label for="division_name">Division Name <span class="text-danger">*</span></label>
                        <select name="division_id" id="division_name" class="form-control @error('division_name') is-invalid @enderror"  >
                            <option value="" selected="" disabled="">Select Division</option>
                            @foreach($division as $div)
                            <option value="{{ $div->id }}">{{ $div->division_name }}</option>
                            @endforeach
                        </select>

                        </div>

                        <label for="district_name">District Name <span class="text-danger">*</span></label>
                        <select name="district_id" id="district_name" class="form-control @error('district_name') is-invalid @enderror"  >
                            <option value="" selected="" disabled="">Select Division</option>
                            @foreach($district as $div)
                            <option value="{{ $div->id }}">{{ $div->district_name }}</option>
                            @endforeach
                        </select>

                        </div>

                        <div class="form-group">
                            <label for="state_name">State Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('state_name') is-invalid @enderror" id="state_name" name="state_name" placeholder="State Name">
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
