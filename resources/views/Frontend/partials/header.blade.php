<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
            {{-- cnt-login  --}}
            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    @guest
                        @if (Route::has('login'))
                        <li class="dropdown dropdown-small"> <a href="{{route('login')}}" class="dropdown-toggle"><span class="value"><i class="icon fa fa-lock"></i> login  </span></a>

                        </li>
                        @endif

                        @else
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><img src="{{(!empty(Auth::user()->profile_photo_path)) ? url('public/upload/user_images/'.Auth::user()->profile_photo_path) : url('public/upload/no_photo.png')}}" width="20" height="20" style="text-align:center; border-radius:50%"><span class="value">{{ucwords(Auth::user()->username)}} </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{route('profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#">German</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            </ul>
                        </li>
                    @endguest
                </ul>
                <!-- /.list-unstyled -->
              </div>
          <div class="cnt-account">
            <ul class="list-unstyled ">
              <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>Wishlist</a></li>
              <li ><a href="#"><i class="icon fa fa-user"></i>My Account</a></li>
              <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
              <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>
            </ul>
          </div>
          <!-- /.cnt-inline -->

          <div class="cnt-block">
            <ul class="list-unstyled list-inline">
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">USD</a></li>
                  <li><a href="#">INR</a></li>
                  <li><a href="#">GBP</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">English</a></li>
                  <li><a href="#">French</a></li>
                  <li><a href="#">German</a></li>
                </ul>
              </li>
            </ul>
            <!-- /.list-unstyled -->
          </div>

          <!-- /.cnt-cart -->
          <div class="clearfix"></div>

        </div>
        <!-- /.header-top-inner -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo"> <a href="{{url('/')}}" style="font-size: 22px; color:#fff; font-family: 'Open Sans', sans-serif;">  E-Market </a> </div>
            <!-- /.logo -->
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->

          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
            <!-- /.contact-row -->
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
              <form>
                <div class="control-group">
                  <ul class="categories-filter animate-dropdown">
                    <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                      <ul class="dropdown-menu" role="menu" >
                        <li class="menu-header">Computer</li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                      </ul>
                    </li>
                  </ul>
                  <input class="search-field" placeholder="Search here..." />
                  <a class="search-button" href="#" ></a> </div>
              </form>
            </div>
            <!-- /.search-area -->
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->

          <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">




            <!-- ================================= SHOPPING CART DROPDOWN ======================================== -->

            <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count" id="cartQty">2</span></div>
                <div class="total-price-basket"> <span class="lbl">cart-</span>
                    <span class="total-price"> <span class="sign">৳</span>
                    <span class="value" id="cartSubTotal"> </span> </span> </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>

                    <div id="miniCart">

                    </div>

                <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text">Sub Total :</span>
                        <span class='price'  id="cartSubTotal">  </span> </div>
                    <div class="clearfix"></div>
                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                </div>
                  <!-- /.cart-total-->

                </li>
              </ul>
              <!-- /.dropdown-menu-->
            </div>
            <!-- /.dropdown-cart -->

            <!-- ================================= SHOPPING CART DROPDOWN : END======================= --> </div>

          <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">
    <li class="active dropdown yamm-fw"> <a href="{{url('/')}}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>
{{-- Category list data --}}
    @php
        $categoris = App\Models\Category::orderBy('category_name_en','ASC')->get();
    @endphp

@foreach ($categoris as $category )

    <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{$category->category_name_en}}</a>
    <ul class="dropdown-menu container">
        <li>
        <div class="yamm-content ">
            <div class="row">

        {{-- Category list data --}}
        @php
        $subcategoris = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
        @endphp
        @foreach ($subcategoris as $subcategory )

            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">

                <h2 class="title"><a style="padding: 0" href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">{{strtoupper($subcategory->subcategory_name_en)}}</a></h2>


                @php
                $subsubcategoris = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en','ASC')->get();
                @endphp

                @foreach ( $subsubcategoris as $subsubcategory )
                    <ul class="links">
                        <li><a href="{{ url('subsubcategory/product/'.$subsubcategory->id.'/'.$subsubcategory->subsubcategory_slug_en ) }}">{{strtoupper($subsubcategory->subsubcategory_name_en)}}</a></li>
                    </ul>
                @endforeach
            </div>
        @endforeach
            <!-- /.col -->
            <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{asset('public/Frontend')}}/assets/images/banners/top-menu-banner.jpg" alt=""> </div>
            <!-- /.yamm-content -->
            </div>
        </div>
        </li>
    </ul>
    </li>
    @endforeach
    <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer -->
            </div>
            <!-- /.navbar-collapse -->

          </div>
          <!-- /.nav-bg-class -->
        </div>
        <!-- /.navbar-default -->
      </div>
      <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

  </header>
