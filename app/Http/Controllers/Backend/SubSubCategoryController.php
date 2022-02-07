<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubSubCategoryController extends Controller
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
        if (is_null($this->user) || !$this->user->can('subsubcategory.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Sub Sub Category !'); }
        $subsubcategory = SubSubCategory::latest()->get();
        $subcategory = SubCategory::orderBy('subcategory_name_en',"ASC")->get();
        $category = Category::orderBy('category_name_en',"ASC")->get();

        return view('Backend.sub-sub-category.sub-sub-category-view',compact('subsubcategory','subcategory','category'));
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
        if (is_null($this->user) || !$this->user->can('subsubcategory.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any Sub Sub Category !'); }

            $request->validate([
                'subcategory_id' => 'required',
                'category_id'   => 'required',
                'subsubcategory_name_en' => 'required',
            ],
        [
            'category_id.required' => 'Please Select an Option',
            'subcategory_id.required' => 'Please Select an Option',
        ]);

            SubSubCategory::insert([
                'subsubcategory_name_en' => $request->subsubcategory_name_en,
                'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,

            ]);

            session()->flash('success', 'Sub Sub Category has been Inserted !!');
            return redirect()->route('admin.subsubcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('subsubcategory.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Sub Sub Category !'); }

            $subsubcategory = SubSubCategory::findOrFail($id);
            $category = Category::orderBy('category_name_en',"ASC")->get();
            $subcategory = SubCategory::orderBy('subcategory_name_en',"ASC")->get();

        return view('Backend.sub-sub-category.sub-sub-category-edit',compact('subsubcategory','subcategory','category'));
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
        if (is_null($this->user) || !$this->user->can('subsubcategory.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Sub Sub Category !'); }

            $request->validate([
                'subsubcategory_name_en' => 'required | unique:sub_sub_categories,subsubcategory_name_en,' . $id,
                'category_id' => 'required',
                'subcategory_id' => 'required',
            ],
        [
            'category_id.requried' => 'Please Select an Option',
            'subcategory_id.requried' => 'Please Select an Option',
        ]);

            $data = SubSubCategory::find($id);
            $data->category_id = $request->category_id;
            $data->subcategory_id = $request->subcategory_id;
            $data->subsubcategory_name_en = $request->subsubcategory_name_en;
            $data->subsubcategory_slug_en = strtolower(str_replace(' ','-',$request->subsubcategory_name_en));
            $data->save();

            session()->flash('success', 'Sub Sub Category has been Updated !!');
            return redirect()->route('admin.subsubcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('subsubcategory.delete')){
            abort(403, " Sorry !! You are Unauthorized to Delete any Sub Sub Category");}

        $subsubcategory = SubSubCategory::find($id);

        if (!is_null($subsubcategory)) {
            $subsubcategory->delete();
        }

        session()->flash('success', 'Sub Sub Category has been deleted !!');
        return back();
    }
}
