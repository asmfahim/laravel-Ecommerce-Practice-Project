@extends('Backend.layouts.app')

@section('title','SUB-SUB-CATEGORY')
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
                <h4 class="header-title">Sub Sub Category List</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Sub Sub Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Auth::guard('admin')->user()->can('subcategory.view'))

                            @foreach ($subsubcategory as  $row)
                            <tr>
                                <td>{{$row['category']['category_name_en']}}</td>
                                <td>{{$row['subcategory']['subcategory_name_en']}}</td>
                                <td>{{$row->subsubcategory_name_en}}</td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        @if (Auth::guard('admin')->user()->can('subsubcategory.edit'))
                                            <li class="mr-2 h5"><a href="{{route('admin.subsubcategory.edit',$row->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                        @endif
                                        @if (Auth::guard('admin')->user()->can('subsubcategory.delete'))
                                            <li class="h5">
                                                <a href="{{route('admin.subsubcategory.destroy',$row->id)}}" class="text-danger" onclick="show_confirm('delete-form-{{$row->id}}')">
                                                    <i class="ti-trash"></i>
                                                </a>

                                                <form id="delete-form-{{ $row->id }}" action="{{ route('admin.subsubcategory.destroy', $row->id) }}" method="POST" style="display: none;">
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
                <h4 class="header-title">Add Sub Sub Category</h4>
                @if (Auth::guard('admin')->user()->can('subsubcategory.create'))

                <div class="data-tables">
                    <form method="post" action="{{route('admin.subsubcategory.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category">Category<span class="text-danger">*</span> </label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category" name="category_id">
                              <option value="" selected="">Select Category</option>
                              @foreach ($category as $row )
                              <option value="{{$row->id}}">{{$row->category_name_en}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="subcategory">Sub Category<span class="text-danger">*</span> </label>
                            <select class="form-control @error('subcategory_id') is-invalid @enderror" id="subcategory" name="subcategory_id">
                                <option value="" selected="">Select Sub Category</option>
                              {{-- @foreach ($subcategory as $row )
                              <option value="{{$row->id}}">{{$row->subcategory_name_en}}</option>
                              @endforeach --}}
                            </select>
                          </div>
                        <div class="form-group">
                        <label for="subsubcategory_name_en">Sub Sub Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('subsubcategory_name_en') is-invalid @enderror" id="subsubcategory_name_en" name="subsubcategory_name_en" placeholder="Sub Sub Category Name">
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
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="category_id"]').on('change',function(){
           let category_id = $(this).val();
           if(category_id){
            $.ajax({
                url:"{{url('/admin/category/sub/ajax')}}/"+category_id,
                type:"GET",
                dataType: "json",
                success:function(data){
                   if(data.length == 0){
                    let d = $('select[name="subcategory_id"]').empty();
                    let e = $('select[name="subcategory_id"]').append('<option value="" selected="">Select Not Found</option>');
                   }
                   else{
                    let d = $('select[name="subcategory_id"]').empty();
                   }

                    $.each(data,function(key,value){
                        $('select[name="subcategory_id"]').append(
                            '<option value="'+value.id +'">'+value.subcategory_name_en + '</option>'
                        );
                    });
                },
            })
           }
           else{
                let d = $('select[name="subcategory_id"]').empty();
                let e = $('select[name="subcategory_id"]').append('<option value="" selected="">Select Sub Category</option>');
           }
        });
    });

   </script>
{{-- Confirm Delete --}}
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
