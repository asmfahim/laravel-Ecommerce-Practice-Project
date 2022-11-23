<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products =Product::latest()->get();
        return view('Backend.product.product-view',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('Backend.product.product-create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_id'   => 'required',
            'subcategory_id'   => 'required',
            'subsubcategory_id'   => 'required',
            'product_name_en'   => 'required',
            'product_code'   => 'required',
            'product_qty'   => 'required',
            'selling_price'   => 'required',
            'discount_price'   => 'required',
            'product_tags_en'   => 'required',
            'product_size_en'   => 'required',
            'product_thambnail'   => 'required',
            'short_descp_en'   => 'required',
        ]);

        $image = $request->file('product_thambnail');
        $imagename = hexdec(uniqid()).$image->getClientOriginalName();
        $location = public_path("upload/products/thambnail");
        // dd($image->getPathname());
        $imgs = Image::make($image->getPathname());
        $imgs->resize(917 , 1000, function ($constraint) { $constraint->aspectRatio(); })->save($location.'/'.$imagename);
        $save_url = $imagename;

      $product_id =  Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,

            'product_name_en' => $request->product_name_en ,
            'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)) ,
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,

            'product_tags_en' => $request->product_tags_en,
            'product_size_en' => $request->product_size_en,
            'product_color_en' => $request->product_color_en,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,

            'short_descp_en' => $request->short_descp_en,
            'long_descp_en' => $request->long_descp_en,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thambnail' => $save_url ,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        // Multi-image start
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $photoName = hexdec(uniqid()).$img->getClientOriginalName();
            $location = public_path("upload/products/multi_image");
            // dd($image->getPathname());
            $imges = Image::make($img->getPathname());
            $imges->resize(917 , 1000, function ($constraint) { $constraint->aspectRatio(); })->save($location.'/'.$photoName);
            $save_path = $photoName;

            MultiImg::Insert([
                'product_id' =>$product_id ,
                'photo_name' => $save_path,
                'created_at' =>Carbon::now() ,
            ]);
        }



        session()->flash('success', 'Product has been Inserted !!');
        return redirect()->route('admin.product.index');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubCategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('Backend.product.product-edit',compact('brands','categories','subCategories','subSubCategories','products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
