
@php

$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();

@endphp



<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">

            @foreach($tags_en as $tag)
                <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_en) }}">
                    {{ str_replace(',',' ',$tag->product_tags_en)  }}
                </a>
            @endforeach

        </div>
      <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
  </div>
  <!-- /.sidebar-widget -->
