<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
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
        if (is_null($this->user) || !$this->user->can('subcategory.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Sub Category !'); }

        $subcategory = SubCategory::all();
        $category = Category::orderBy('category_name_en',"ASC")->get();

        return view('Backend.sub-category.subcategory-view',compact('subcategory','category'));
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
        if (is_null($this->user) || !$this->user->can('subcategory.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any Sub Category !'); }

            $request->validate([
                'subcategory_name_en' => 'required',
                'category_id'   => 'required',
            ],
        [
            'category_id.required' => 'Please Select an Option'
        ]);

            SubCategory::insert([
                'subcategory_name_en' => $request->subcategory_name_en,
                'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
                'category_id' => $request->category_id,

            ]);

            session()->flash('success', 'Sub Category has been Inserted !!');
            return redirect()->route('admin.subcategory.index');
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
        if (is_null($this->user) || !$this->user->can('subcategory.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Sub Category !'); }

            $subcategory = SubCategory::findOrFail($id);
            $category = Category::orderBy('category_name_en',"ASC")->get();

        return view('Backend.sub-category.subcategory-edit',compact('subcategory','category'));
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
        if (is_null($this->user) || !$this->user->can('subcategory.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Sub Category !'); }

            $request->validate([
                'subcategory_name_en' => 'required | unique:sub_categories,subcategory_name_en,' . $id,
                'category_id' => 'required'
            ],
        [
            'category_id.requried' => 'Please Select an Option'
        ]);

            $data = SubCategory::find($id);
            $data->category_id = $request->category_id;
            $data->subcategory_name_en = $request->subcategory_name_en;
            $data->subcategory_slug_en = strtolower(str_replace(' ','-',$request->subcategory_name_en));
            $data->save();

            session()->flash('success', 'Sub Category has been Updated !!');
            return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('subcategory.delete')){
            abort(403, " Sorry !! You are Unauthorized to Delete any Sub Category");}

        $subcategory = SubCategory::find($id);

        if (!is_null($subcategory)) {
            $subcategory->delete();
        }

        session()->flash('success', 'Sub Category has been deleted !!');
        return back();
    }
}
