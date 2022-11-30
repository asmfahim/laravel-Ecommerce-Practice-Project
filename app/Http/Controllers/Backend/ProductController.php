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
        $multiimgs = MultiImg::where('product_id',$id)->get();

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubCategories = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('Backend.product.product-edit',compact('brands','categories','subCategories','subSubCategories','products','multiimgs'));

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
        Product::findOrFail($id)->update([
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

            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        session()->flash('success', 'Product has been Updated !! without image.');
        return redirect()->route('admin.product.index');
    }

    public function multiimgupdate(Request $request){
        $imgs = $request->multi_img;
        foreach($imgs as $id=> $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink(public_path('upload/products/multi_image/'.$imgDel->photo_name));
            $image_name = hexdec(uniqid()).$img->getClientOriginalName();
            $path = public_path("upload/products/multi_image");
            $imgs_make = Image::make($img->getPathname());
            $imgs_make->resize(917 , 1000, function ($constraint) { $constraint->aspectRatio(); })->save($path.'/'.$image_name);
            $update_url = $image_name;

            MultiImg::where('id',$id)->update([
                'photo_name'=>$update_url,
                'updated_at'=>Carbon::now(),
            ]);
        }
        session()->flash('success', 'Product Image has been Updated !!');
        return redirect()->back();
    }

    public function thambnailupdate(Request $request,$id){
        $thamb_Img = Product::findOrFail($id);
        $img_thamb = $request->thambnail_img;
        unlink(public_path('upload/products/thambnail/'.$thamb_Img->product_thambnail));
        $thamb_image_name = hexdec(uniqid()).$img_thamb->getClientOriginalName();
        $path = public_path("upload/products/thambnail");
        $imgs_makes = Image::make($img_thamb->getPathname());
        $imgs_makes->resize(917 , 1000, function ($constraint) { $constraint->aspectRatio(); })->save($path.'/'.$thamb_image_name);
        $update_path = $thamb_image_name;

        Product::where('id',$id)->update([
            'product_thambnail'=>$update_path,
            'updated_at'=>Carbon::now(),
        ]);
        session()->flash('success', 'Product Thambnail has been Updated !!');
        return redirect()->back();
    }

    public function product_inactive($id){

        Product::findOrFail($id)->update([
            'status' => 0
        ]);

        session()->flash('success', 'Productn Inactivated !!');
        return redirect()->back();
    }

    public function product_active($id){

        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        session()->flash('success', 'Product Activated !!');
        return redirect()->back();
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
        $product = Product::findOrFail($id);
        unlink(public_path('upload/products/thambnail/'.$product->product_thambnail));
        // File::delete(public_path('upload/products/thambnail/'.$product->producth_thambnail));
        Product::findOrFail($id)->delete();
        $multi_image = MultiImg::where('product_id',$id)->get();
        foreach($multi_image as $img_multi){
            unlink(public_path('upload/products/multi_image/'.$img_multi->photo_name));
            // File::delete(public_path('upload/products/multi_image/'.$img->photo_name));
            MultiImg::where('product_id',$id)->delete();
        }

        session()->flash('success', 'Product has been deleted !!');
        return redirect()->back();
    }
}
