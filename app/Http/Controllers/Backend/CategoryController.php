<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
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
        if (is_null($this->user) || !$this->user->can('category.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Category !'); }

        $category = Category::all();

        return view('Backend.category.category-view',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('category.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any Category !'); }

            $request->validate([
                'category_name_en' => 'required',
                'category_icon'   => 'required',
            ]);

            Category::insert([
                'category_name_en' => $request->category_name_en,
                'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
                'category_icon' => $request->category_icon,

            ]);

            session()->flash('success', 'Category has been Inserted !!');
            return redirect()->route('admin.category.index');
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
        if (is_null($this->user) || !$this->user->can('category.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Category !'); }

            $category = Category::find($id);
            return view('Backend.category.category-edit',compact('category'));
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
        if (is_null($this->user) || !$this->user->can('category.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Category !'); }

            $request->validate([
                'category_name_en' => 'required | unique:categories,category_name_en,' . $id,
            ]);

            $data = Category::find($id);
            $data->category_name_en = $request->category_name_en;
            $data->category_slug_en = strtolower(str_replace(' ','-',$request->category_name_en));
            $data->category_icon = $request->category_icon;
            $data->save();

            session()->flash('success', 'Category has been Updated !!');
            return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('category.delete')){
            abort(403, " Sorry !! You are Unauthorized to Delete any Brand");}

        $category = Category::find($id);

        if (!is_null($category)) {
            $category->delete();
        }

        session()->flash('success', 'Category has been deleted !!');
        return back();
    }
}
