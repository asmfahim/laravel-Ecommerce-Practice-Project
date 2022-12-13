<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content=" {{ csrf_token() }} ">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title> @yield('title')</title>

{{-- fav icon  --}}
<link rel="shortcut icon" type="image/png" href="{{asset('public/Frontend')}}/assets/images/logo/logo3.png">

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/main.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/blue.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/owl.carousel.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/owl.transitions.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/animate.min.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/rateit.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/bootstrap-select.min.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@yield('style')
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
    @include('Frontend.partials.header')

<!-- ============================================== HEADER : END ============================================== -->

<!-- /#top-banner-and-menu -->

@yield('content')

<!-- ========================================== FOOTER ======================================= -->
@include('Frontend.partials.footer')
<!-- ========================================= FOOTER : END===================================== -->





<!-- ========================================== MODEL ======================================= -->

<!-- Add to Cart Product Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

         <div class="row">

          <div class="col-md-4">

            <div class="card" style="width: 18rem;">
                <img src=" " class="card-img-top" alt="..." style="height: 200px; width: 200px;" id="pimage">
            </div>

          </div><!-- // end col md -->


        <div class="col-md-4">

            <ul class="list-group">
                <li class="list-group-item text-muted">
                    Product Price:
                    <strong class="text-info">৳ <span id="pprice"></span></strong> <br/> <del>৳ <span id="oldprice"></span></del>
                </li>
                <li class="list-group-item text-muted">Product Code:<br/> <strong class="text-info" id="pcode"></strong></li>
                <li class="list-group-item text-muted">Category:<br/> <strong class="text-info" id="pcategory"></strong></li>
                <li class="list-group-item text-muted">Brand:<br/> <strong class="text-info" id="pbrand"></strong></li>
                <li class="list-group-item">
                    Stock:
                    <span class="badge badge-pill badge-success" id="aviable" style="background: green; color: white;"></span>
                    <span class="badge badge-pill badge-danger" id="stockout" style="background: red; color: white;"></span>
                </li>
            </ul>

        </div><!-- // end col md -->


        <div class="col-md-4">

            <div class="form-group">
                <label class="text-muted" for="color">Choose Color</label>
                <select class="form-control text-info" id="color" name="color">

                </select>qty
color

            </div>  <!-- // end form group -->


            <div class="form-group" id="sizeArea">
            <label class="text-muted" for="size">Choose Size</label>
            <select class="form-control text-info" id="size" name="size">

            </select>
          </div>  <!-- // end form group -->

            <div class="form-group">
                <label class="text-muted" for="qty">Quantity</label>
                <input type="number" class="form-control text-info" id="qty" value="1" min="1" >
            </div> <!-- // end form group -->

            <input type="hidden" id="product_id">
            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()" >Add to Cart</button>


        </div><!-- // end col md -->



        </div><!-- // end col md -->


         </div> <!-- // end row -->


        </div> <!-- // end modal Body -->

      </div>
    </div>
  </div>
  <!-- End Add to Cart Product Modal -->

<!-- ========================================= MODEL : END===================================== -->





<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Frontend')}}/assets/js/jquery-1.11.1.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/owl.carousel.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/echo.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/jquery.easing-1.3.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap-slider.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="{{asset('public/Frontend')}}/assets/js/lightbox.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('public/Frontend')}}/assets/js/wow.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/scripts.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
// Start Product View with Modal
function productView(id){
    // alert(id)
    $.ajax({
        type: 'GET',
        url: '/laravel-Ecommerce-Practice-Project/product/view/modal/'+id,
        dataType:'json',
        success:function(data){

            console.log(data)
            $('#pname').text(data.product.product_name_en);
            $('#price').text(data.product.selling_price);
            $('#pcode').text(data.product.product_code);
            $('#pcategory').text(data.product.category.category_name_en);
            $('#pbrand').text(data.product.brand.brand_name_en);
            $('#pimage').attr('src','/laravel-Ecommerce-Practice-Project/public/upload/products/thambnail/'+data.product.product_thambnail);

            $('#product_id').val(id);
            $('#qty').val(1);

            // Product Price
            if (data.product.discount_price == null) {
                $('#pprice').text('');
                $('#oldprice').text('');
                $('#pprice').text(data.product.selling_price);
            }else{
                $('#pprice').text(data.product.discount_price);
                $('#oldprice').text(data.product.selling_price);
            } // end prodcut price

            // Start Stock opiton
            if (data.product.product_qty > 0) {
                $('#aviable').text('');
                $('#stockout').text('');
                $('#aviable').text('aviable');
            }else{
                $('#aviable').text('');
                $('#stockout').text('');
                $('#stockout').text('stockout');
            } // end Stock Option

            // Color
            $('select[name="color"]').empty();
            $.each(data.color,function(key,value){
                $('select[name="color"]').append('<option value=" '+value+' ">'+value+' </option>')
             }) // end color

            // Size
            $('select[name="size"]').empty();
            $.each(data.size,function(key,value){
                $('select[name="size"]').append('<option value=" '+value+' ">'+value+' </option>')
                if (data.size == "") {
                    $('#sizeArea').hide();
                }else{
                    $('#sizeArea').show();
                }
            }) // end size

        }
    })

} //end product view with modal

// Start Add To Cart Product
function addToCart(){
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                color:color, size:size, quantity:quantity, product_name:product_name
            },
            url: "/laravel-Ecommerce-Practice-Project/cart/data/store/"+id,
            success:function(data){
                $('#closeModel').click();
                console.log(data)

                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message

            }
        })
    }


</script>

{{-- mini Cart part  --}}
<script type="text/javascript">


function miniCart(){
        $.ajax({
            type: 'GET',
            url: '/laravel-Ecommerce-Practice-Project/product/mini/cart',
            dataType:'json',
            success:function(response){
                // console.log(response)

                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);
                var miniCart = ""
                $.each(response.carts, function(key,value){
                    miniCart += `<div class="cart-item product-summary">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="image">
                                     <a href="detail.html">
                                        <img src="/laravel-Ecommerce-Practice-Project/public/upload/products/thambnail/${value.options.image}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <h3 class="name">
                                    <a href="index.php?page-detail">${value.name}</a>
                                </h3>
                                <div class="price"> ${value.price} * ${value.qty}</div>
                            </div>
                            <div class="col-xs-1 action">
                                <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div><!-- /.cart-item -->
                    <div class="clearfix"></div>
                    <hr>`
        });

                $('#miniCart').html(miniCart);

            }
        })
     }

     miniCart();


      /// mini cart remove Start
    function miniCartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: '/laravel-Ecommerce-Practice-Project/minicart/product-remove/'+rowId,
            dataType:'json',
            success:function(data){
            miniCart();
             // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message
            }
        });
    }
 //  end mini cart remove


</script> {{--End mini Cart part  --}}


<!--  /// Start Add Wishlist Page  //// -->

<script type="text/javascript">

    function addToWishList(product_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/laravel-Ecommerce-Practice-Project/add-to-wishlist/"+product_id,
            success:function(data){

                    // Start Message
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',

                      showConfirmButton: false,
                      timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                // End Message

            }
        })
    }
</script> <!--  /// End Add Wishlist Page  //// -->


<!-- /// Load Wishlist Data  -->


<script type="text/javascript">
    function wishlist(){
       $.ajax({
           type: 'GET',
           url: '/laravel-Ecommerce-Practice-Project/get-wishlist-product',
           dataType:'json',
           success:function(response){
               var rows = ""
               $.each(response, function(key,value){
                   rows += `<tr>
                   <td class="col-md-2"><img src="/laravel-Ecommerce-Practice-Project/public/upload/products/thambnail/${value.product.product_thambnail} " alt="imga"></td>
                   <td class="col-md-7">
                       <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>

                       <div class="price">
                       ${value.product.discount_price == null
                           ? `${value.product.selling_price}`
                           :
                           `${value.product.discount_price} <span>${value.product.selling_price}</span>`
                       }

                       </div>
                            </td>
                <td class="col-md-2">
                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
                </td>
                <td class="col-md-1 close-btn">
                    <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
                </td>
                        </tr>`
                });

               $('#wishlist').html(rows);
           }
       })
    }

wishlist();

 ///  Wishlist remove Start
 function wishlistRemove(id){
        $.ajax({
            type: 'GET',
            url: '/laravel-Ecommerce-Practice-Project/wishlist-remove/'+id,
            dataType:'json',
            success:function(data){
            wishlist();
             // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',

                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
            }
        });
    }
 // End Wishlist remove


</script>

<!-- /// End Load Wisch list Data  -->


<!-- /// Load My Cart /// -->

<script type="text/javascript">
    function cart(){
       $.ajax({
           type: 'GET',
           url: '/laravel-Ecommerce-Practice-Project/get-cart-product',
           dataType:'json',
           success:function(response){
   var rows = ""
   $.each(response.carts, function(key,value){
       rows += `<tr>
       <td class="col-md-2"><img src="/laravel-Ecommerce-Practice-Project/public/upload/products/thambnail/${value.options.image} " alt="imga"  style="width:60px; height:60px;"></td>

       <td class="col-md-2">
           <div class="product-name"><a href="#">${value.name}</a></div>

           <div class="price">
                           ${value.price}
                       </div>
                   </td>

        <td class="col-md-2">
            <strong>${value.options.color} </strong>
            </td>
         <td class="col-md-2">
          ${value.options.size == null
            ? `<span> .... </span>`
            :
          `<strong>${value.options.size} </strong>`
          }
            </td>
           <td class="col-md-2">
            ${value.qty > 1
            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button> `
            : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `
            }
            <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" >
            <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button>
            </td>
             <td class="col-md-2">
            <strong>$${value.subtotal} </strong>
            </td>


       <td class="col-md-1 close-btn">
        <button type="submit" class="" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
       </td>
               </tr>`
       });

               $('#cartPage').html(rows);
           }
       })
    }
cart();
///  Cart remove Start
   function cartRemove(id){
       $.ajax({
           type: 'GET',
           url: '/laravel-Ecommerce-Practice-Project/cart-remove/'+id,
           dataType:'json',
           success:function(data){
            cart();
            miniCart();
            // Start Message
               const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',

                     showConfirmButton: false,
                     timer: 3000
                   })
               if ($.isEmptyObject(data.error)) {
                   Toast.fire({
                       type: 'success',
                       icon: 'success',
                       title: data.success
                   })
               }else{
                   Toast.fire({
                       type: 'error',
                       icon: 'error',
                       title: data.error
                   })
               }
               // End Message
           }
       });
   }
// End Cart remove

 // -------- CART INCREMENT --------//
 function cartIncrement(rowId){
        $.ajax({
            type:'GET',
            url: "/laravel-Ecommerce-Practice-Project/cart-increment/"+rowId,
            dataType:'json',
            success:function(data){
                cart();
                miniCart();
            }
        });
    }
 // ---------- END CART INCREMENT -----///


  // -------- CART Decrement  --------//
  function cartDecrement(rowId){
        $.ajax({
            type:'GET',
            url: "/laravel-Ecommerce-Practice-Project/cart-decrement/"+rowId,
            dataType:'json',
            success:function(data){
                cart();
                miniCart();
            }
        });
    }
 // ---------- END CART Decrement -----///


<!-- /// End Load Wisch list Data  -->
</script>

<!-- //End Load My cart / -->




@yield('scripts')





<script type="text/javascript">
    @if ($errors->any())
       @foreach ($errors->all() as $error)
           toastr.error("{!! $error !!}");
       @endforeach
   @endif
</script>


@if (Session::has('success'))
<script type="text/javascript">
   toastr.success("{!! Session::get('success') !!}");
</script>
@endif

</body>
</html>

