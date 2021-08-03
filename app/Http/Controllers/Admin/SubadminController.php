<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubadminController extends Controller
{
    /**
     This controller is admin type user with role and permission
     */
	 
	 
    public function index()
    {
        $users = User::with('role')->where('role_id','!=',2)->get();
		
        return view('admin.subadmin.index',compact('users'));
    }

 
    public function create()
    {
        $roles = Role::where('id','!=',2)->get();
		
        return view('admin.subadmin.create',compact('roles'));
    }

   
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'role_id' => 'required|numeric',
        ]);

        $request['password'] = Hash::make($request->password);
		
        User::create($request->all());
		
        $notification=array(
            'message'=>'user Created Success',
            'alert-type'=>'success'
        );
		
        return Redirect()->route('subadmin.index')->with($notification);
    }

  
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $user = User::find($id);
		
        $roles = Role::where('id','!=',2)->get();
		
        return view('admin.subadmin.edit',compact('user','roles'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:4|confirmed',
            'role_id' => 'required|numeric',
        ]);

        if ($request->password === null) 
		{
            $request['password'] = auth()->user()->password;
        }
		else 
		{
            $request['password'] = Hash::make($request->password);
        }
		
		//update data
        User::findOrFail($id)->update($request->all());
		
        $notification=array(
            'message'=>'user Update Success',
            'alert-type'=>'success'
        );
		
        return Redirect()->route('subadmin.index')->with($notification);
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
		
        $notification=array(
            'message'=>'User Delete Success',
            'alert-type'=>'success'
        );
		
        return Redirect()->back()->with($notification);
    }
	
	

}
