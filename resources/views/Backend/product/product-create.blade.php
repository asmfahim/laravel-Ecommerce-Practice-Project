@extends('Backend.layouts.app')

@section('title','SUB-SUB-CATEGORY')
@section('styles')
<link rel="stylesheet" href="{{asset("public/Backend/assets/src/bootstrap-tagsinput.css")}}">
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
    <div class="col-lg-6 col-ml-12">
        <div class="row">
            <div class="col-lg-6 col-ml-12">
                <div class="row">
                    <!-- basic form start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Add Product</h4>
                                <form>
                                    {{-- 1st row  --}}
                                    <div class=" form-row">
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label">Brand</label>
                                            <select class="custom-select @error('brand_id') is-invalid @enderror" name="brand_id">
                                                <option value="0" selected="">Select Brand</option>
                                                @foreach ($brands as $row )
                                                    <option value="{{$row->id}}"> {{$row->brand_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label">Category</label>
                                            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id">
                                                <option value="" selected="">Select Category</option>
                                                @foreach ($categories as  $row)
                                                    <option value="{{$row->id}}">{{$row->category_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label ">Sub Category</label>
                                            <select class="custom-select  @error('subcategory_id') is-invalid @enderror" name="subcategory_id">
                                                <option value="" selected="">Select Sub Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- 2nd row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label">Sub Sub Category</label>
                                            <select class="custom-select  @error('category_id') is-invalid @enderror" name="subsubcategory_id">
                                                <option value="" selected="">Select Sub Sub Category</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_name_en">Product Name</label>
                                            <input type="text" class="form-control  @error('product_name_en') is-invalid @enderror" id="product_name_en" name="product_name_en" placeholder="Product Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_code">Product Code</label>
                                            <input type="text" class="form-control  @error('product_code') is-invalid @enderror" id="product_code" name="product_code"  placeholder="Product Code">
                                        </div>
                                    </div>
                                    {{-- 3rd row  --}}
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="product_qty">Product Quantity</label>
                                            <input type="text" class="form-control  @error('product_qty') is-invalid @enderror" id="product_qty" name="product_qty" placeholder="Product Quantity">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="selling_price">Product Selling Price</label>
                                            <input type="text" class="form-control  @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" placeholder="Product Selling Price">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="discount_price">Product Discount Price</label>
                                            <input type="text" class="form-control  @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price" placeholder="Product Discount Price">
                                        </div>
                                    </div>
                                    {{-- 4th row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="product_tags_en">Product Tags</label><br>
                                            <input type="text" class="form-control  @error('product_tags_en') is-invalid @enderror" id="product_tags_en" name="product_tags_en" value="asm,sayed,fahim" data-role="tagsinput" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_size_en">Product Size</label><br>
                                            <input type="text" class="form-control  @error('product_size_en') is-invalid @enderror" id="product_size_en" name="product_size_en" value="Small, Medium, Large" data-role="tagsinput" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_color_en">Product Color</label><br>
                                            <input type="text" class="form-control @error('product_color_en') is-invalid @enderror" id="product_color_en" name="product_color_en" value="Red,Black,White" data-role="tagsinput" >
                                        </div>
                                    </div>

                                    {{-- 5th row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="product_thambnail">Main Thambnail</label><br>
                                            <input type="file" class="form-control @error('product_thambnail') is-invalid @enderror" id="product_thambnail" name="product_thambnail" >
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="multi_img">Multiple Image</label><br>
                                            <input type="file" class="form-control @error('multi_img') is-invalid @enderror" id="multi_img" name="multi_img[]" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="short_descp_en">Short Description</label>
                                            <textarea class="form-control @error('short_descp_en') is-invalid @enderror" name="short_descp_en" id="short_descp_en" rows="2"></textarea>
                                        </div>
                                    </div>

                                    {{-- 6th row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="editor1">Long Description</label>
                                            <textarea class="form-control @error('long_descp_en') is-invalid @enderror" style="visibility: hidden; display: none;" id="editor1" name="long_descp_en" rows="6" cols="80"></textarea>
                                        </div>
                                    </div>

                                    {{-- 7th row  --}}

                                    <hr>
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('hot_deals') is-invalid @enderror" name="hot_deals" value="1" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Hot Deals</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('featured') is-invalid @enderror" name="featured" value="1" id="exampleCheck2">
                                                <label class="form-check-label" for="exampleCheck2">Featured</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('special_offer') is-invalid @enderror" name="special_offer" value="1" id="exampleCheck3">
                                                <label class="form-check-label" for="exampleCheck3">Special Offer</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('special_deals') is-invalid @enderror" name="special_deals" value="1" id="exampleCheck4">
                                                <label class="form-check-label" for="exampleCheck4">Special Deals</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- basic form end -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

{{-- Sub Category ajax --}}
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
                    let e = $('select[name="subcategory_id"]').append('<option value="" selected="">Sub Category</option>');
                    let f = $('select[name="subsubcategory_id"]').empty();
                    let g = $('select[name="subsubcategory_id"]').append('<option value="" selected="">Select Sub Sub Category</option>');
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
                let f = $('select[name="subsubcategory_id"]').empty();
                let g = $('select[name="subsubcategory_id"]').append('<option value="" selected="">Select Sub Sub Category</option>');

           }
        });
    });

    $(document).ready(function(){
        $('select[name="subcategory_id"]').on('change',function(){
           let subcategory_id = $(this).val();
           if(subcategory_id){
            $.ajax({
                url:"{{url('/admin/category/sub/sub/ajax')}}/"+subcategory_id,
                type:"GET",
                dataType: "json",
                success:function(data){
                   if(data.length == 0){
                    let d = $('select[name="subsubcategory_id"]').empty();
                    let e = $('select[name="subsubcategory_id"]').append('<option value="" selected="">Select Not Found</option>');
                   }
                   else{
                    let d = $('select[name="subsubcategory_id"]').empty();
                    let e = $('select[name="subsubcategory_id"]').append('<option value="" selected="">Sub Sub Category</option>');
                   }

                    $.each(data,function(key,value){
                        $('select[name="subsubcategory_id"]').append(
                            '<option value="'+value.id +'">'+value.subsubcategory_name_en + '</option>'
                        );
                    });
                },
            })
           }
           else{
                let d = $('select[name="subsubcategory_id"]').empty();
                let e = $('select[name="subsubcategory_id"]').append('<option value="" selected="">Select Sub Sub Category</option>');
           }
        });
    });

   </script>
{{-- sub sub category ajax --}}
<script type="text/javascript">


   </script>

<script src="{{asset("public/Backend/assets/src/bootstrap-tagsinput.js")}}"></script>
<script src="{{asset("public/Backend/assets/editor/ckeditor/ckeditor.js")}}"></script>
<script src="{{asset("public/Backend/assets/editor/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js")}}"></script>
<script src="{{asset("public/Backend/assets/editor/editor.js")}}"></script>

@endsection
