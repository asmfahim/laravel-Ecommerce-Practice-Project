<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $id=Auth::user()->id;
        $user = User::find($id);
        return view('Frontend.profile.profile-view',compact('user'));
    }

    public function edit(){
        $id=Auth::user()->id;
        $user = User::find($id);
        return view('Frontend.profile.profile-edit',compact('user'));
    }
    public function update(REQUEST $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'phone' => 'required | min:11 | numeric | unique:users,phone_number,' . $id,
            'address' => 'required',
            'profile_photo_path' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ],[
            'name.requried' => 'Please give a admin user name',
            'email.requried' => 'Please give an email address',
            'password.confirmed' => 'Password must be same',
            'phone.required' => 'Plese give a phone number',
            'address.required' => 'Plese give an address',
        ]);

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone_number = $request->phone;
        $data->address = $request->address;
        $data->gender = $request->gender;
        if($request->file('profile_photo_path')){
            if(File::exists(public_path('upload/user_images/'.$data->profile_photo_path))){
                File::delete(public_path('upload/user_images/'.$data->profile_photo_path));
            }

            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$fileName);
            $data->profile_photo_path = $fileName;
        }

        $data->save();

        session()->flash('success', 'Profile has been Updated !!');
        return redirect()->route('profile.edit');
    }
    public function change_password(REQUEST $request, $id){
        $request->validate([
            'oldpassword' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|different:oldpassword',
            'password_confirmation' => 'required_with:new_password|same:new_password|string|min:8',
            ], [
            'password_confirmation.required_with' => 'Confirm password is required.'
            ]);

        $data = User::find($id);

            if( !(Hash::check($request->oldpassword, $data->password))){
                return back()->withErrors('Please Enter Correct Password!!');
            }
            else{

                $data->password = Hash::make($request->new_password);
                $data->save();
                session()->flash('success', 'Password Update Successfully !');
                return redirect()->route('profile.edit');
            }
    }
}
