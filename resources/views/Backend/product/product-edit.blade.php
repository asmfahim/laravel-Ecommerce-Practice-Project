@extends('Backend.layouts.app')

@section('title','PRODUCT EDIT')
@section('styles')
<link rel="stylesheet" href="{{asset("public/Backend/assets/src/bootstrap-tagsinput.css")}}">
<style>

    .image-container,.thumb-container{
        height:100px;
        width: 160px;
        border-radius: 6px;
        margin-left: 5px;
        margin-top: 5px;
        overflow: hidden;
    }
    .image-container img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
    .thumb-container img{
        object-fit: cover;
    }
    .image-container span , .thumb-container span{
        top: -6px;
        right: 8px;
        color: red;
        font-size: 28px;
        cursor: pointer;
    }
</style>
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
                                <h4 class="header-title">Edit Product</h4>
                                <form method="POST" action="{{route("admin.product.store")}}" enctype="multipart/form-data">
                                    @csrf
                                    {{-- 1st row  --}}
                                    <div class=" form-row">
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label">Brand</label>
                                            <select class="custom-select @error('brand_id') is-invalid @enderror" name="brand_id">
                                                <option value="0" selected="">Select Brand</option>
                                                @foreach ($brands as $row )
                                                    <option value="{{$row->id}}"{{$row->id == $products->brand_id ? 'selected':' '}}> {{$row->brand_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label">Category</label>
                                            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id">
                                                <option value="" selected="">Select Category</option>
                                                @foreach ($categories as  $row)
                                                    <option value="{{$row->id}}" {{$row->id == $products->category_id ? 'selected':' '}}>{{$row->category_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label ">Sub Category</label>
                                            <select class="custom-select  @error('subcategory_id') is-invalid @enderror" name="subcategory_id">
                                                <option value="" selected="">Select Sub Category</option>
                                                @foreach ($subCategories as  $row)
                                                <option value="{{$row->id}}" {{$row->id == $products->subcategory_id ? 'selected':' '}}>{{$row->subcategory_name_en}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- 2nd row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label">Sub Sub Category</label>
                                            <select class="custom-select  @error('category_id') is-invalid @enderror" name="subsubcategory_id">
                                                <option value="" selected="">Select Sub Sub Category</option>
                                                @foreach ($subSubCategories as  $row)
                                                <option value="{{$row->id}}" {{$row->id == $products->subsubcategory_id ? 'selected':' '}}>{{$row->subsubcategory_name_en}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_name_en">Product Name</label>
                                            <input type="text" class="form-control  @error('product_name_en') is-invalid @enderror" id="product_name_en" name="product_name_en" placeholder="Product Name" value="{{$products->product_name_en}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_code">Product Code</label>
                                            <input type="text" class="form-control  @error('product_code') is-invalid @enderror" id="product_code" name="product_code"  placeholder="Product Code"value="{{$products->product_code}}">
                                        </div>
                                    </div>
                                    {{-- 3rd row  --}}
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="product_qty">Product Quantity</label>
                                            <input type="text" class="form-control  @error('product_qty') is-invalid @enderror" id="product_qty" name="product_qty" placeholder="Product Quantity" value="{{$products->product_qty}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="selling_price">Product Selling Price</label>
                                            <input type="text" class="form-control  @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" placeholder="Product Selling Price"value="{{$products->selling_price}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="discount_price">Product Discount Price</label>
                                            <input type="text" class="form-control  @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price" placeholder="Product Discount Price" value="{{$products->discount_price}}">
                                        </div>
                                    </div>
                                    {{-- 4th row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="product_tags_en">Product Tags</label><br>
                                            <input type="text" class="form-control  @error('product_tags_en') is-invalid @enderror" id="product_tags_en" name="product_tags_en" value="demo1,demo2" data-role="tagsinput" value="{{$products->product_tags_en}}" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_size_en">Product Size</label><br>
                                            <input type="text" class="form-control  @error('product_size_en') is-invalid @enderror" id="product_size_en" name="product_size_en" value="Small, Medium, Large" data-role="tagsinput" value="{{$products->product_size_en}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="product_color_en">Product Color</label><br>
                                            <input type="text" class="form-control @error('product_color_en') is-invalid @enderror" id="product_color_en" name="product_color_en" value="Red,Black,White" data-role="tagsinput" value="{{$products->product_color_en}}">
                                        </div>
                                    </div>

                                    {{-- 5th row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="short_descp_en">Short Description</label>
                                            <textarea class="form-control @error('short_descp_en') is-invalid @enderror" name="short_descp_en" id="short_descp_en" rows="2"> {!!$products->short_descp_en!!}</textarea>
                                        </div>
                                    </div>
                                    {{-- row of image show --}}


                                    {{-- 6th row  --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="editor1">Long Description</label>
                                            <textarea class="form-control @error('long_descp_en') is-invalid @enderror" style="visibility: hidden; display: none;" id="editor1" name="long_descp_en" rows="6" cols="80">{!! $products->long_descp_en!!}</textarea>
                                        </div>
                                    </div>

                                    {{-- 7th row  --}}

                                    <hr>
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('hot_deals') is-invalid @enderror" name="hot_deals" value="1" id="exampleCheck1" {{$products->hot_deals == 1 ? 'checked':''}}>
                                                <label class="form-check-label" for="exampleCheck1">Hot Deals</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('featured') is-invalid @enderror" name="featured" value="1" id="exampleCheck2" {{$products->featured == 1 ? 'checked':''}}>
                                                <label class="form-check-label" for="exampleCheck2">Featured</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('special_offer') is-invalid @enderror" name="special_offer" value="1" id="exampleCheck3">
                                                <label class="form-check-label" for="exampleCheck3"{{$products->special_offer == 1 ? 'checked':''}}>Special Offer</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input @error('special_deals') is-invalid @enderror" name="special_deals" value="1" id="exampleCheck4">
                                                <label class="form-check-label" for="exampleCheck4" {{$products->special_deals == 1 ? 'checked':''}}>Special Deals</label>
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

{{-- sub category --}}

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


   </script>
    {{-- sub sub category ajax --}}
<script type="text/javascript">
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
   {{-- Thumbnail image  --}}
   <script type="text/javascript">
        $(document).ready(function(){
        $('#product_thambnail').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
               $('#thumb_img').attr('src',e.target.result).width(100).height(100);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
   </script>
   {{-- multi_imgae --}}
   <script type="text/javascript">
        var images = [];
        // var a = [];
        function multi_imgs(){
            var image = document.getElementById("multi_img").files;
            for( i =0; i<image.length; i++){
                images.push({
                    "name" : image[i].name,
                    "url" : URL.createObjectURL(image[i]),
                    "file" : image[i],
                });
                // a[i] = image[i];
            }
            // document.getElementById('multi_img').refresh();
            console.log(images);

            if(images != null){
                document.getElementById('img_reselect').style.display = "block";
                document.getElementById("image_multi").innerHTML = img_show();
            }
        }
        function img_reset(){
            document.getElementById('multi_img').value = null;
            document.getElementById("image_multi").innerHTML = img_refresh();
            images =[];
            multi_imgs();
            document.getElementById('img_reselect').style.display = "none";
        }
        function img_show(){
            var image = "";
            images.forEach((i) => {
                image +=  '<div class="d-flex justify-content-center image-container position-relative"><img src="'+i.url +'"  alt=""> </div>';
                // <span class="position-absolute" onclick= "img_delete('+images.indexOf(i)+')">&times;</span></div>'
            });
            return image;
        }
        function img_refresh(){
            var image = "";

            return image;
        }
        // function img_delete(e){
        //     images.splice(e,1);
        //     // a.splice(e,1);
        //     document.getElementById("image_multi").innerHTML = img_show();
        //     document.getElementById("multi_img").value = images.file;

        // }

   </script>

<script src="{{asset("public/Backend/assets/src/bootstrap-tagsinput.js")}}"></script>
<script src="{{asset("public/Backend/assets/editor/ckeditor/ckeditor.js")}}"></script>
<script src="{{asset("public/Backend/assets/editor/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js")}}"></script>
<script src="{{asset("public/Backend/assets/editor/editor.js")}}"></script>

@endsection
