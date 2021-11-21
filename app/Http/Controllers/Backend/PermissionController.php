<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index(){
        if (is_null($this->user) || !$this->user->can('permission.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any create !'); }

        return view('Backend.role-permission.permission-create');
    }

    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('permission.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any create !'); }

        $request->validate([
            'group_name' => 'required|max:100|unique:permissions,group_name,'
        ], [
            'group_name.requried' => 'Please give a group name'
        ]);

        for($i = 0; $i <count($request->checkPermissions); $i++){
        Permission::create(['guard_name' => 'admin','name' => $request->checkPermissions[$i], 'group_name' => $request->group_name]);
        }
        return back();
    }
}
