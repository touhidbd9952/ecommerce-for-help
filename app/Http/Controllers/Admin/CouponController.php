<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //create
    public function create(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('admin.coupon.create',compact('coupons'));
    }

    //store
    public function store(Request $request){
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
        $notification=array(
            'message'=>'Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
       }

       //edit
    public function edit($coupon_id){
        $coupon= Coupon::findOrFail($coupon_id);
        return view('admin.coupon.edit',compact('coupon'));
    }

    //update
    public function update(Request $request){
        $coupon_id = $request->id;
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ]);

        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('coupon')->with($notification);
    }

    //destroy
    public function destroy($coupon_id){
        Coupon::findOrFail($coupon_id)->delete();
        $notification=array(
            'message'=>'Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}

