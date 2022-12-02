<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $categoris = Category::orderBy('category_name_en','ASC')->get();
        return view('Frontend.layouts.index',compact('categoris','sliders'));
    }
}
