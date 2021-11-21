@extends('Backend.layouts.app')

@section('title','Admin User')
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
                <h4 class="page-title pull-left">{{__('User List')}}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ $usr->can('dashboard.view') || $usr->can('dashboard.edit') ? route('admin.dashboard') : ''}}">Home</a></li>
                    <li><span>User List</span></li>
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
                    <h4 class="header-title">User List</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Sl. No</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User Phone Number</th>
                                    <th>User Assign Role </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as  $row)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->phone_number}}</td>
                                    <td>
                                        @foreach ($row->roles as $role)
                                            {{$role->name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                <li class="mr-2 h5"><a href="{{route('admin.user.edit',$row->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                            @endif
                                            @if (Auth::guard('admin')->user()->can('admin.delete'))
                                                <li class="h5">
                                                    <a href="{{route('admin.user.destroy',$row->id)}}" class="text-danger" onclick="show_confirm('delete-form-{{$row->id}}')">
                                                        <i class="ti-trash"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $row->id }}" action="{{ route('admin.user.destroy', $row->id) }}" method="POST" style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </li>
                                            @endif

                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
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
