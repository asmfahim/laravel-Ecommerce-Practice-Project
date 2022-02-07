<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class AjaxController extends Controller
{

    //Sub Category ajax
    public function Sub_Ajax($id){
        $subcate = SubCategory::where('category_id', $id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcate);
    }
    // Sub sub category ajax
    public function SubSub_Ajax($id){
        $subsubcate = SubSubCategory::where('subcategory_id', $id)->orderBy('subsubcategory_name_en','ASC')->get();

        return json_encode($subsubcate);
    }
}
