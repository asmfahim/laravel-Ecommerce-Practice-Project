@extends('Frontend.layouts.app')
@section('title', 'SubCategory Wise Product')

@section('styles')
{{-- for css style --}}

@endsection

@section('content')

{{-- breadcrumb start --}}
<div class="breadcrumb">
    <div class="container">
      <div class="breadcrumb-inner">
        <ul class="list-inline list-unstyled">
          <li><a href="{{url('/')}}">Home</a></li>
          <li class="active">Sub Category</li>
        </ul>
      </div>
      <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
  </div>

  {{-- breadcrumb end --}}

  {{-- body content start --}}

  <div class="body-content outer-top-xs">
    <div class="container">
      <div class="row">
        <div class="col-md-3 sidebar">
          <!-- ================================== TOP NAVIGATION ================================== -->
         @include('Frontend.common.vertical_menu')
          <!-- ================================== TOP NAVIGATION : END ================================== -->
          <div class="sidebar-module-container">
            <div class="sidebar-filter">
              <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
              <div class="sidebar-widget wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h3 class="section-title">shop by</h3>
                <div class="widget-header">
                  <h4 class="widget-title">Category</h4>
                </div>
                <div class="sidebar-widget-body">
                  <div class="accordion">




            @foreach($categories as $category)
                <div class="accordion-group">
                <div class="accordion-heading"> <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                   {{ucfirst( $category->category_name_en) }} </a> </div>
                <!-- /.accordion-heading -->
                <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
                <div class="accordion-inner">

            @php
            $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
            @endphp

        @foreach($subcategories as $subcategory)
                <ul>
                <li><a href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
                   {{ucfirst( $subcategory->subcategory_name_en) }} </a></li>

                </ul>
            @endforeach


            </div>
            <!-- /.accordion-inner -->
            </div>
            <!-- /.accordion-body -->
            </div>
            <!-- /.accordion-group -->
        @endforeach

                  </div>
                  <!-- /.accordion -->
                </div>
                <!-- /.sidebar-widget-body -->
              </div>
              <!-- /.sidebar-widget -->
              <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

              <!-- ============================================== PRICE SILDER============================================== -->
              <div class="sidebar-widget wow fadeInUp" style="visibility: hidden; animation-name: none;">
                <div class="widget-header">
                  <h4 class="widget-title">Price Slider</h4>
                </div>
                <div class="sidebar-widget-body m-t-10">
                  <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                    <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                    <div class="slider slider-horizontal" id=""><div class="slider-track"><div class="slider-selection" style="left: 16.6667%; width: 50%;"></div><div class="slider-handle min-slider-handle" style="left: 16.6667%;" tabindex="0"></div><div class="slider-handle max-slider-handle" style="left: 66.6667%;" tabindex="0"></div></div><div class="tooltip tooltip-main top" style="left: 41.6667%; margin-left: -35px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">200 : 500</div></div><div class="tooltip tooltip-min top" style="left: 16.6667%; margin-left: -35px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">200</div></div><div class="tooltip tooltip-max bottom" style="top: 18px; left: 66.6667%; margin-left: -35px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">500</div></div></div><input type="text" class="price-slider" value="200,500" style="display: none;" data="value: '200,500'">
                  </div>
                  <!-- /.price-range-holder -->
                  <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
                <!-- /.sidebar-widget-body -->
              </div>
              <!-- /.sidebar-widget -->
              <!-- ============================================== PRICE SILDER : END ============================================== -->
              <!-- ============================================== MANUFACTURES============================================== -->
              <div class="sidebar-widget wow fadeInUp" style="visibility: hidden; animation-name: none;">
                <div class="widget-header">
                  <h4 class="widget-title">Manufactures</h4>
                </div>
                <div class="sidebar-widget-body">
                  <ul class="list">
                    <li><a href="#">Forever 18</a></li>
                    <li><a href="#">Nike</a></li>
                    <li><a href="#">Dolce &amp; Gabbana</a></li>
                    <li><a href="#">Alluare</a></li>
                    <li><a href="#">Chanel</a></li>
                    <li><a href="#">Other Brand</a></li>
                  </ul>
                  <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
                </div>
                <!-- /.sidebar-widget-body -->
              </div>
              <!-- /.sidebar-widget -->
              <!-- ============================================== MANUFACTURES: END ============================================== -->
              <!-- ============================================== COLOR============================================== -->
              <div class="sidebar-widget wow fadeInUp" style="visibility: hidden; animation-name: none;">
                <div class="widget-header">
                  <h4 class="widget-title">Colors</h4>
                </div>
                <div class="sidebar-widget-body">
                  <ul class="list">
                    <li><a href="#">Red</a></li>
                    <li><a href="#">Blue</a></li>
                    <li><a href="#">Yellow</a></li>
                    <li><a href="#">Pink</a></li>
                    <li><a href="#">Brown</a></li>
                    <li><a href="#">Teal</a></li>
                  </ul>
                </div>
                <!-- /.sidebar-widget-body -->
              </div>
              <!-- /.sidebar-widget -->
              <!-- ============================================== COLOR: END ============================================== -->
              <!-- ============================================== COMPARE============================================== -->
              <div class="sidebar-widget wow fadeInUp outer-top-vs" style="visibility: hidden; animation-name: none;">
                <h3 class="section-title">Compare products</h3>
                <div class="sidebar-widget-body">
                  <div class="compare-report">
                    <p>You have no <span>item(s)</span> to compare</p>
                  </div>
                  <!-- /.compare-report -->
                </div>
                <!-- /.sidebar-widget-body -->
              </div>
              <!-- /.sidebar-widget -->
              <!-- ============================================== COMPARE: END ============================================== -->
              <!-- ============================================== PRODUCT TAGS ============================================== -->
              @include('Frontend.common.product_tags')
              <!-- ============================================== End PRODUCT TAGS ============================================== -->

              <!-- /.sidebar-widget -->
            <!----------- Testimonials------------->
            @include('Frontend.common.testimonials')

              <!-- ============================================== Testimonials: END ============================================== -->

              <div class="home-banner"> <img src="{{asset('public/Frontend')}}/assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
            </div>
            <!-- /.sidebar-filter -->
          </div>
          <!-- /.sidebar-module-container -->
        </div>
        <!-- /.sidebar -->
        <div class="col-md-9">
          <!-- ========================================== SECTION – HERO ========================================= -->

          <div id="category" class="category-carousel hidden-xs">
            <div class="item">
              <div class="image"> <img src="{{asset('public/Frontend')}}/assets/images/banners/cat-banner-1.jpg" alt="" class="img-responsive"> </div>
              <div class="container-fluid">
                <div class="caption vertical-top text-left">
                  <div class="big-text"> Big Sale </div>
                  <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                  <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>
                </div>
                <!-- /.caption -->
              </div>
              <!-- /.container-fluid -->
            </div>
          </div>


          <div class="clearfix filters-container m-t-10">
            <div class="row">
              <div class="col col-sm-6 col-md-2">
                <div class="filter-tabs">
                  <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                    <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                  </ul>
                </div>
                <!-- /.filter-tabs -->
              </div>
              <!-- /.col -->
              <div class="col col-sm-12 col-md-6">
                <div class="col col-sm-3 col-md-6 no-padding">
                  <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                    <div class="fld inline">
                      <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                        <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                        <ul role="menu" class="dropdown-menu">
                          <li role="presentation"><a href="#">position</a></li>
                          <li role="presentation"><a href="#">Price:Lowest first</a></li>
                          <li role="presentation"><a href="#">Price:HIghest first</a></li>
                          <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.fld -->
                  </div>
                  <!-- /.lbl-cnt -->
                </div>
                <!-- /.col -->
                <div class="col col-sm-3 col-md-6 no-padding">
                  <div class="lbl-cnt"> <span class="lbl">Show</span>
                    <div class="fld inline">
                      <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                        <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                        <ul role="menu" class="dropdown-menu">
                          <li role="presentation"><a href="#">1</a></li>
                          <li role="presentation"><a href="#">2</a></li>
                          <li role="presentation"><a href="#">3</a></li>
                          <li role="presentation"><a href="#">4</a></li>
                          <li role="presentation"><a href="#">5</a></li>
                          <li role="presentation"><a href="#">6</a></li>
                          <li role="presentation"><a href="#">7</a></li>
                          <li role="presentation"><a href="#">8</a></li>
                          <li role="presentation"><a href="#">9</a></li>
                          <li role="presentation"><a href="#">10</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.fld -->
                  </div>
                  <!-- /.lbl-cnt -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.col -->
              <div class="col col-sm-6 col-md-4 text-right">

                <!-- /.pagination-container -->
            </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <div class="search-result-container ">
            <div id="myTabContent" class="tab-content category-list">
              <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                  <div class="row">


    @foreach($products as $product)
  <div class="col-sm-6 col-md-4 wow fadeInUp">
    <div class="products">
      <div class="product">
        <div class="product-image">
          <div class="image"> <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img  src="{{ asset('public/upload/products/thambnail/'.$product->product_thambnail) }}" alt="" height="200"></a> </div>
          <!-- /.image -->

           @php
        $amount = $product->selling_price - $product->discount_price;
        $discount = ($amount/$product->selling_price) * 100;
        @endphp

          <div>
            @if ($product->discount_price == NULL)
            <div class="tag new"><span>new</span></div>
            @else
            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
            @endif
          </div>


        </div>
        <!-- /.product-image -->

        <div class="product-info text-left">
          <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
          	{{ $product->product_name_en }} </a></h3>
          <div class="rating rateit-small"></div>
          <div class="description"></div>


@if ($product->discount_price == NULL)
<div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span>   </div>

@else

<div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
@endif




          <!-- /.product-price -->

        </div>
        <!-- /.product-info -->
        <div class="cart clearfix animate-effect">
          <div class="action">
            <ul class="list-unstyled">
              <li class="add-cart-button btn-group">
                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
              </li>
              <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
              <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
            </ul>
          </div>
          <!-- /.action -->
        </div>
        <!-- /.cart -->
      </div>
      <!-- /.product -->

    </div>
    <!-- /.products -->
  </div>
  <!-- /.item -->
  @endforeach



                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.category-product -->

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane " id="list-container">
                <div class="category-product">


                    @foreach ($products as $product )

                    <div class="category-product-inner wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                      <div class="products">
                        <div class="product-list product">
                          <div class="row product-list-row">
                            <div class="col col-sm-4 col-lg-4">
                              <div class="product-image">
                                <div class="image"> <img src="{{ asset('public/upload/products/thambnail/'.$product->product_thambnail) }}" alt="" height="250"> </div>
                              </div>
                              <!-- /.product-image -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-8 col-lg-8">
                              <div class="product-info">
                                <h3 class="name"><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">{{ $product->product_name_en }}</a></h3>

                                <div class="rating rateit-small rateit">
                                    {{-- <button id="rateit-reset-14" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-14" style="display: none;"></button>
                                    <div id="rateit-range-14" class="rateit-range" tabindex="0" role="slider" aria-label="rating" aria-owns="rateit-reset-14" aria-valuemin="0" aria-valuemax="5" aria-valuenow="4" style="width: 70px; height: 14px;" aria-readonly="true">
                                        <div class="rateit-selected" style="height: 14px; width: 56px;"></div>
                                        <div class="rateit-hover" style="height:14px"></div>
                                    </div> --}}
                                </div>

                                @if ($product->discount_price == NULL)
                                <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span>  </div>
                                @else
                                <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
                                @endif
                                <!-- /.product-price -->
                                {{-- description  --}}
                                <div class="description m-t-10">
                                    {{ $product->short_descp_en }}
                                </div>
                                {{-- description end  --}}
                                <div class="cart clearfix animate-effect">
                                  <div class="action">
                                    <ul class="list-unstyled">
                                      <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                      </li>
                                      <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                      <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                    </ul>
                                  </div>
                                  <!-- /.action -->
                                </div>
                                <!-- /.cart -->

                              </div>
                              <!-- /.product-info -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.product-list-row -->

                          @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                          @endphp

                        @if ($product->discount_price == NULL)
                        <div class="tag new"><span>new</span></div>
                        @else
                        <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                        @endif
                        </div>
                        <!-- /.product-list -->
                      </div>
                      <!-- /.products -->
                    </div>
                    @endforeach


                  <!-- /.category-product-inner -->


                </div>
                <!-- /.category-product -->
              </div>
              <!-- /.tab-pane #list-container -->
            </div>
            <!-- /.tab-content -->
            <div class="clearfix filters-container">
              <div class="text-right">
                <div class="pagination-container">
                  <ul class="list-inline list-unstyled">
                    {{ $products->links()  }}
                  </ul>
                  <!-- /.list-inline -->
                </div>
                <!-- /.pagination-container --> </div>
              <!-- /.text-right -->

            </div>
            <!-- /.filters-container -->

          </div>
          <!-- /.search-result-container -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- ============================================== BRANDS CAROUSEL ============================================== -->
      @include('Frontend.partials.brands')
      <!-- /.logo-slider -->
      <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> </div>
    <!-- /.container -->

  </div>


@endsection
