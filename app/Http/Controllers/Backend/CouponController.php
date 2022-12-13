<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
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

        if (is_null($this->user) || !$this->user->can('coupon.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Coupon !'); }

        $coupons = Coupon::orderBy('id','DESC')->get();
    	return view('Backend.coupon.coupon-view',compact('coupons'));
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

        if (is_null($this->user) || !$this->user->can('coupon.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any Coupon !'); }


        $request->validate([
    		'coupon_name' => 'required',
    		'coupon_discount' => 'required',
    		'coupon_validity' => 'required',

    	]);



	Coupon::insert([
		'coupon_name' => strtoupper($request->coupon_name),
		'coupon_discount' => $request->coupon_discount,
		'coupon_validity' => $request->coupon_validity,
		'created_at' => Carbon::now(),

    	]);


		session()->flash('success', 'Coupon has been Inserted Successfully !!');
        return redirect()->route('admin.coupon.index');


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
        if (is_null($this->user) || !$this->user->can('coupon.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Coupon !'); }

            $coupons = Coupon::findOrFail($id);
            return view('Backend.coupon.coupon-edit',compact('coupons'));



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

        if (is_null($this->user) || !$this->user->can('coupon.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any Coupon !'); }

            Coupon::findOrFail($id)->update([
                'coupon_name' => strtoupper($request->coupon_name),
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
                'created_at' => Carbon::now(),

                ]);


                session()->flash('success', 'Coupon has been Updated Successfully !!');
                return redirect()->route('admin.coupon.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('coupon.delete')){
            abort(403, " Sorry !! You are Unauthorized to Delete any Coupon");}

            Coupon::findOrFail($id)->delete();

            session()->flash('success', 'Coupon has been Deleted Successfully !!');
            return redirect()->route('admin.coupon.index');
    }
}
