<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        if (is_null($this->user) || !$this->user->can('profile.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view Profile !'); }
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::find($id);
        return view('Backend.profile.profile-view',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (is_null($this->user) || !$this->user->can('profile.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit Profile !'); }
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::find($id);
        return view('Backend.profile.profile-edit',compact('admin'));
    }

    public function update(Request $request , $id)
    {
        if (is_null($this->user) || !$this->user->can('profile.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to Edit Profile !'); }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'phone' => 'required | min:11 | numeric | unique:admins,phone_number,' . $id,
            'address' => 'required',
            'profile_photo_path' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ],[
            'name.requried' => 'Please give a admin user name',
            'email.requried' => 'Please give an email address',
            'password.confirmed' => 'Password must be same',
            'phone.required' => 'Plese give a phone number',
            'address.required' => 'Plese give an address',
        ]);

        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone;
        $data->address = $request->address;
        $data->gender = $request->gender;
        if($request->file('profile_photo_path')){
            if(File::exists(public_path('upload/admin_images/'.$data->profile_photo_path))){
                File::delete(public_path('upload/admin_images/'.$data->profile_photo_path));
            }

            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$fileName);
            $data->profile_photo_path = $fileName;
        }

        $data->save();

        session()->flash('success', 'Profile has been Updated !!');
        return redirect()->route('admin.profile.edit');
    }

    public function change_password(Request $request, $id){

        $request->validate([
            'oldpassword' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|different:oldpassword',
            'password_confirmation' => 'required_with:new_password|same:new_password|string|min:8',
            ], [
            'password_confirmation.required_with' => 'Confirm password is required.'
            ]);

        $data = Admin::find($id);

            if( !(Hash::check($request->oldpassword, $data->password))){
                return back()->withErrors('Please Enter Correct Password!!');
            }
            else{

                $data->password = Hash::make($request->new_password);
                $data->save();
                session()->flash('success', 'Password Update Successfully !');
                return redirect()->route('admin.profile.edit');
            }

    }

}
