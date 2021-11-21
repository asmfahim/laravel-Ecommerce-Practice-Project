<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Admin view !'); }
        $admin = Admin::all();
        return view('Backend.user.user-view',compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, " Sorry !! You are Unauthorized to create any admin ");}
        $roles = Role::all();
        return view('Backend.user.user-create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, " Sorry !! You are Unauthorized to create any admin ");}

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required | max:255|email |unique:admins,email',
            'password' => 'required | min:8 | confirmed',
            'phone' => 'required | min:11 | numeric | unique:admins,phone_number',
            'address' => 'required'
        ], [
            'name.requried' => 'Please give a admin user name',
            'email.requried' => 'Please give an email address',
            'password.requried' => 'Please give a password',
            'password.confirmed' => 'Password must be same',
            'phone.required' => 'Plese give a phone number',
            'address.required' => 'Plese give an address',
        ]);

        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone;
        $user->address = $request->address;
        $user->save();

        if($request->role){
            $user->assignRole($request->role);
        }
        session()->flash('success', 'User has been created !!');
        return redirect()->route('admin.user.index');

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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, " Sorry !! You are Unauthorized to create any admin edit ");}

        $user = Admin::find($id);
        $roles = Role::all();

        return view('Backend.user.user-edit',compact('user','roles'));
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, " Sorry !! You are Unauthorized to create any admin edit");}

        $user = Admin::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'phone' => 'required | min:11 | numeric | unique:admins,phone_number,' . $id,
            'address' => 'required'
        ]);


        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->phone_number = $request->phone;
        $user->address = $request->address;
        $user->save();

        $user->roles()->detach();
        if ($request->role) {
            $user->assignRole($request->role);
        }

        session()->flash('success', 'User has been updated !!');
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.delete')){
            abort(403, " Sorry !! You are Unauthorized to create any admin delete");}
        $user = Admin::find($id);
        if (!is_null($user)) {
            $user->delete();
        }

        session()->flash('success', 'User has been deleted !!');
        return back();
    }
}
