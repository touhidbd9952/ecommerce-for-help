<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index()
	{
        return view('admin.home');
    }

    // =============================== profile =============================
    public function profile()
	{
        return view('admin.profile.index');
    }

    ////////// updated personal info
    public function updateInfo(Request $request)
	{
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ],[
            'name.required' => 'input your name',
        ]);

        User::findOrFail(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);

        $notification=array(
            'message'=>'Your Profile Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // image updated
    public function updateImgPage()
	{
        return view('admin.profile.change-image');
    }

    // admin image store
    public function imgStore(Request $request)
	{
        $old_image = $request->old_image;

        if (User::findOrFail(Auth::id())->image == 'fontend/media/avatar.png') 
		{
			//image upload
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('fontend/media/'.$name_gen);
			
            $save_url = 'fontend/media/'.$name_gen;
			
            User::findOrFail(Auth::id())->Update([
                'image' => $save_url
            ]);
			
            $notification=array(
                'message'=>'Image Successfully Updated',
                'alert-type'=>'success'
            );
			
            return Redirect()->back()->with($notification);

        }
		else 
		{
            unlink($old_image);
			
			//image upload
            $image = $request->file('image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('fontend/media/'.$name_gen);
			
            $save_url = 'fontend/media/'.$name_gen;
			
            User::findOrFail(Auth::id())->Update([
                'image' => $save_url
            ]);
			
            $notification=array(
                'message'=>'Image Successfully Updated',
                'alert-type'=>'success'
            );
			
            return Redirect()->back()->with($notification);
    	}
 }

 /// change password
 public function changePass()
 {
     return view('admin.profile.password');
 }

 public function changePassStore(Request $request)
 {
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:8',
        'password_confirmation' => 'required|min:8',
    ]);

    $db_pass = Auth::user()->password;
    $current_password = $request->old_password;
    $newpass = $request->new_password;
    $confirmpass = $request->password_confirmation;

   if (Hash::check($current_password,$db_pass)) 
   {
      if ($newpass === $confirmpass) 
	  {
          User::findOrFail(Auth::id())->update([
           		 'password' => Hash::make($newpass)
           ]);

          Auth::logout();
		  
          $notification=array(
            	'message'=>'Your Password Change Success. Now Login With New Password',
            	'alert-type'=>'success'
        	);
			
       	 	return Redirect()->route('login')->with($notification);

      }
	  else 
	  {

			$notification=array(
				'message'=>'New Password And Confirm Password Not Same',
				'alert-type'=>'success'
			);
			
			return Redirect()->back()->with($notification);
      }
   }
   else 
   {
		$notification=array(
			'message'=>'Old Password Not Match',
			'alert-type'=>'error'
		);
		
		return Redirect()->back()->with($notification);
   }
 }


 ////////////////////////////// ALl Users ==================
 public function allUsers()
 {
     $users = User::where('role_id','!=',1)->orderBy('id','DESC')->get();
	 
     return view('admin.users.index',compact('users'));
 }

    //banned user
    public function banned($user_id)
	{
        User::findOrFail($user_id)->update(['isban' => 1]);
		
        $notification=array(
            'message'=>'User Banned',
            'alert-type'=>'error'
        );
		
        return Redirect()->back()->with($notification);
    }

     //unbanned user
    public function unBanned($user_id)
	{
        User::findOrFail($user_id)->update(['isban' => 0]);
		
        $notification=array(
        'message'=>'User UnBanned Success',
        'alert-type'=>'success'
    	);
		
   		 return Redirect()->back()->with($notification);
    }

}
