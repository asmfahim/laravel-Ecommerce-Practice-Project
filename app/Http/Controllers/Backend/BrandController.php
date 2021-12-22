<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function Brand_Index(){

        if (is_null($this->user) || !$this->user->can('brand.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Brand !'); }

        $brands = Brand::latest()->get();

        return view('Backend.brand.brand-view',compact('brands'));
    }

    public function Brand_Store(Request $request){

        if (is_null($this->user) || !$this->user->can('brand.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any Brand !'); }

        $request->validate([
            'brand_name_en' => 'required',
            'brand_image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('brand_image');
        $input['imagename'] = hexdec(uniqid()).$image->getClientOriginalName();
        $location = public_path("upload/brand");
        // dd($image->getPathname());
        $imgs = Image::make($image->getPathname());
        $imgs->resize(300 , 300, function ($constraint) { $constraint->aspectRatio(); })->save($location.'/'.$input['imagename']);
        $save_url = $input['imagename'];

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_image' => $save_url,

        ]);

        session()->flash('success', 'Brand has been Inserted !!');
        return redirect()->route('admin.brand.index');

    }
    //end store method
    public function Brand_Edit($id){
        if (is_null($this->user) || !$this->user->can('brand.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Brand !'); }

            $brand = Brand::find($id);
            return view('Backend.brand.brand-edit',compact('brand'));
    }

    public function Brand_Update(Request $request, $id){
        
        if (is_null($this->user) || !$this->user->can('brand.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Brand !'); }

            $request->validate([
                'brand_name_en' => 'required',
                'brand_image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $data = Brand::find($id);
            $data->brand_name_en = $request->brand_name_en;
            $data->brand_slug_en = strtolower(str_replace(' ','-',$request->brand_name_en));
            if($request->file('brand_image')){
                if(File::exists(public_path('upload/brand/'.$data->brand_image))){
                    File::delete(public_path('upload/brand/'.$data->brand_image));
                }

                $image = $request->file('brand_image');
                $input['imagename'] = hexdec(uniqid()).$image->getClientOriginalName();
                $location = public_path("upload/brand");
                // dd($image->getPathname());
                $imgs = Image::make($image->getPathname());
                $imgs->resize(300 , 300, function ($constraint) { $constraint->aspectRatio(); })->save($location.'/'.$input['imagename']);
                $data->brand_image = $input['imagename'];
            }
            $data->save();

            session()->flash('success', 'Brand has been Updated !!');
            return redirect()->route('admin.brand.index');
    }

    public function Brand_Destroy($id){
        if(is_null($this->user) || !$this->user->can('brand.delete')){
            abort(403, " Sorry !! You are Unauthorized to Delete any Brand");}

        $brand = Brand::find($id);
        File::delete(public_path('upload/brand/'.$brand->brand_image));

        if (!is_null($brand)) {
            $brand->delete();
        }

        session()->flash('success', 'Brand has been deleted !!');
        return back();
    }
}
