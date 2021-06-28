<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function orderTrackNow(Request $request){
         $order = Order::with('division','district','state','user')->where('invoice_no',$request->invoice_no)->first();
         if ($order) {
            $orderItems = OrderItem::with('product')->where('order_id',$order->id)->orderBy('id','DESC')->get();
            return view('fontend.order-track',compact('order','orderItems'));
         }else {
            $notification=array(
                'message'=>'Order Not Found',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
         }

    }
}
