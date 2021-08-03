<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::where('id','!=',2)->get();
		
        return view('admin.role.index',compact('roles'));
    }


    public function create()
    {
        return view('admin.role.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create($request->all());
		
        $notification=array(
            'message'=>'Role Created Success',
            'alert-type'=>'success'
        );
		
        return Redirect()->route('role.index')->with($notification);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $role = Role::find($id);
		
        return view('admin.role.edit',compact('role'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::findOrFail($id)->update($request->all());
		
        $notification=array(
            'message'=>'Role Update Success',
            'alert-type'=>'success'
        );
		
        return Redirect()->route('role.index')->with($notification);
    }


    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
		
        $notification=array(
            'message'=>'Role Delete Success',
            'alert-type'=>'success'
        );
		
        return Redirect()->back()->with($notification);
    }
	
	
}
