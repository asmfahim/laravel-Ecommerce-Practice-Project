<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    // This part for Division, Start here

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (is_null($this->user) || !$this->user->can('shipping.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any shipping !'); }

        $divisions = ShipDivision::orderBy('id','DESC')->get();
		return view('Backend.ship.division.view-division',compact('divisions'));
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

        if (is_null($this->user) || !$this->user->can('shipping.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any shipping !'); }

        $request->validate([
    		'division_name' => 'required',

    	]);

        ShipDivision::insert([

            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),

            ]);

        session()->flash('success', 'Shipping has been Inserted Successfully !!');
        return redirect()->route('admin.shipping.index');


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
        if (is_null($this->user) || !$this->user->can('shipping.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any shipping !'); }

            $divisions = ShipDivision::findOrFail($id);
            return view('Backend.ship.division.edit-division',compact('divisions'));
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
        if (is_null($this->user) || !$this->user->can('shipping.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any shipping !'); }

            ShipDivision::findOrFail($id)->update([

                'division_name' => $request->division_name,
                'created_at' => Carbon::now(),

                ]);

                session()->flash('success', 'Shipping has been Updated Successfully !!');
                return redirect()->route('admin.shipping.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         if(is_null($this->user) || !$this->user->can('shipping.delete')){
            abort(403, " Sorry !! You are Unauthorized to Delete any shipping");}

            ShipDivision::findOrFail($id)->delete();

            session()->flash('success', 'Shipping has been Deleted Successfully !!');
            return redirect()->route('admin.shipping.index');


    }

    // Division part End here

    // District part Start Here

    public function District_Index()
    {

        if (is_null($this->user) || !$this->user->can('shipping.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any shipping !'); }

        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::with('division')->orderBy('id','DESC')->get();
		return view('Backend.ship.district.district-view',compact('district','division'));
    }


    public function District_Store(Request $request)
    {

        if (is_null($this->user) || !$this->user->can('shipping.create')) {
            abort(403, 'Sorry !! You are Unauthorized to Create any shipping !'); }

            $request->validate([
                'division_id' => 'required',
                'district_name' => 'required',

            ]);


        ShipDistrict::insert([

            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),

            ]);

        session()->flash('success', 'Shipping has been Inserted Successfully !!');
        return redirect()->route('admin.shipping.district.index');


    }

    public function District_Edit($id)
    {
        if (is_null($this->user) || !$this->user->can('shipping.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any shipping !'); }

            $division = ShipDivision::orderBy('division_name','ASC')->get();
            $district = ShipDistrict::findOrFail($id);
            return view('Backend.ship.district.district-edit',compact('district','division'));
    }

    public function District_Update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('shipping.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit any shipping !'); }

            ShipDistrict::findOrFail($id)->update([

                'division_id' => $request->division_id,
                'district_name' => $request->district_name,
                'created_at' => Carbon::now(),

                ]);

                session()->flash('success', 'Shipping has been Updated Successfully !!');
                return redirect()->route('admin.shipping.district.index');

    }

    public function District_Destroy($id)
    {
         if(is_null($this->user) || !$this->user->can('shipping.delete')){
            abort(403, " Sorry !! You are Unauthorized to Delete any shipping");}

            ShipDistrict::findOrFail($id)->delete();

            session()->flash('success', 'Shipping has been Deleted Successfully !!');
            return redirect()->route('admin.shipping.district.index');


    }


}
