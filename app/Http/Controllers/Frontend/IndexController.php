<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;

class IndexController extends Controller
{
    public function index(){
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(6)->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $categoris = Category::orderBy('category_name_en','ASC')->get();
        $features = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hotdeals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $specialoffers = Product::where('special_offer',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(6)->get();
        $specialdeals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(6)->get();

        $skip_category_0 = Category::skip(0)->first();
    	$skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();

    	$skip_category_1 = Category::skip(1)->first();
    	$skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

    	$skip_brand_1 = Brand::skip(1)->first();
    	$skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();



        return view('Frontend.layouts.index',compact('categoris','sliders','products','features','hotdeals','specialoffers','specialdeals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1'));
    }

    // product details
    public function productdetails($id,$slug){
        $multi_imgs = MultiImg::where('product_id',$id)->get();
        $product_details = Product::findOrFail($id);
        return view('Frontend.product.product-details',compact('product_details','multi_imgs'));
    }

    //Tag wise prodect
    public function TagWiseProduct($tag){
		$products = Product::where('status',1)->where('product_tags_en',$tag)->orderBy('id','DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en','ASC')->get();
		return view('Frontend.tag.tag-view',compact('products','categories'));

	}

      // Subcategory wise data
	public function SubCatWiseProduct($subcat_id,$slug){
		$products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('Frontend.product.subcategory-view',compact('products','categories'));

	}

      // Sub-Subcategory wise data
	public function SubSubCatWiseProduct($subsubcat_id,$slug){
		$products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
		return view('Frontend.product.sub_subcategory-view',compact('products','categories'));

	}








}
