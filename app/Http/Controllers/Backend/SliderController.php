<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::latest()->get();
        return view('Backend.slider.slider-view',compact('sliders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('slider.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any Slider !'); }

        $request->validate([

            'slider_img'   => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ],[
            'slider_img.required' => 'Please select an image'
        ]);

        $image = $request->file('slider_img');
        $imagename = hexdec(uniqid()).$image->getClientOriginalName();
        $location = public_path("upload/sliders");
        // dd($image->getPathname());
        $imgs = Image::make($image->getPathname());
        $imgs->resize(870 , 370, function ($constraint) { $constraint->aspectRatio(); })->save($location.'/'.$imagename);
        $save_url = $imagename;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'slider_description' => $request->slider_description,
            'slider_img' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        session()->flash('success', 'Slider successfully Inserted !!');
        return redirect()->route('admin.slider.index');

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

    public function slider_inactive($id){
        Slider::findOrFail($id)->update([
            'status' => 0,
        ]);
        session()->flash('success', 'Inactive Slider !!');
        return redirect()->route('admin.slider.index');
    }

    public function slider_active($id){
        Slider::findOrFail($id)->update([
            'status'=> 1,
        ]);
        session()->flash('success', 'Active Slider !!');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('Backend.slider.slider-edit',compact('slider'));
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
        if (is_null($this->user) || !$this->user->can('slider.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Update any Slider !'); }

        $request->validate([

            'slider_img'   => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ],[
            'slider_img.required' => 'Please select an image'
        ]);
        $slider = Slider::findOrFail($id);
        unlink(public_path('upload/sliders/'.$slider->slider_img));

        $img = $request->file('slider_img');
        $imagename = hexdec(uniqid()).$img->getClientOriginalName();
        $location = public_path("upload/sliders");
        // dd($image->getPathname());
        $imgs = Image::make($img->getPathname());
        $imgs->resize(870 , 370, function ($constraint) { $constraint->aspectRatio(); })->save($location.'/'.$imagename);
        $save_url = $imagename;

        Slider::findOrFail($id)->update([
            'slider_title' => $request->slider_title,
            'slider_description' => $request->slider_description,
            'slider_img' => $save_url,
            'updated_at' => Carbon::now(),

        ]);

        session()->flash('success', 'Slider successfully Updated !!');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('slider.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Slider delete !'); }

        $slider_del = Slider::findOrFail($id);

        unlink(public_path('upload/sliders/'.$slider_del->slider_img));
        Slider::findOrFail($id)->delete();

        session()->flash('success', 'Slider deleted Successfully !!');
        return redirect()->back();
    }
}
