
@php
$categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
@endphp

          <div class="side-menu animate-dropdown outer-bottom-xs">
            <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
            <nav class="yamm megamenu-horizontal">
              <ul class="nav">

                @foreach ($categories as $category )

                    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon  {{$category->category_icon}}" aria-hidden="true"></i>{{$category->category_name_en}}</a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                        <div class="row">
                                    {{-- Sub Category list data --}}
                    @php
                    $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                    @endphp
                    @foreach ($subcategories as $subcategory)


            {{-- Sub SubCategory list data --}}
                    @php
                        $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en','ASC')->get();
                    @endphp

            <div class="col-sm-12 col-md-3">

                    <h2 class="title font-weight-bold" ><a style="padding: 0" href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">{{strtoupper($subcategory->subcategory_name_en)}}</a></h2>


                @foreach ($subsubcategories as $subsubcategory )
                    <ul class="links list-unstyled">
                        <li><a href="{{ url('subsubcategory/product/'.$subsubcategory->id.'/'.$subsubcategory->subsubcategory_slug_en ) }}">{{strtoupper($subsubcategory->subsubcategory_name_en)}}</a></li>

                    </ul>
                @endforeach
            </div>
        @endforeach

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                    <!-- /.menu-item -->
                @endforeach


                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
                  <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a>
                  <!-- ================================== MEGAMENU VERTICAL ================================== -->
                  <!-- /.dropdown-menu -->
                  <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a>
                  <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

              </ul>
              <!-- /.nav -->
            </nav>
            <!-- /.megamenu-horizontal -->
          </div>
          <!-- /.side-menu -->
