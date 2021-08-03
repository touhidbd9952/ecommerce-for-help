<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\orderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function store(Request $request)
	{
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        }else {
            $total_amount = round(Cart::total());
        }

        \Stripe\Stripe::setApiKey('sk_test_fAbqMVCkCwIqxFL7nhfgpG1e00RazfME62');
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Payment From W3 Coders',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);


        $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'payment_type' => 'Stripe',
                'payment_method' => 'Stripe',
                'payment_type' => $charge->payment_method,
                'transaction_id' => $charge->balance_transaction,
                'currency' => $charge->currency,
                'amount' => $total_amount,
                'order_number' => $charge->metadata->order_id,
                'invoice_no' => 'SPM'.mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
            ]);

            $invoice = Order::findOrFail($order_id);

        //start send email
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount' => $total_amount,
            ];

            Mail::to($request->email)->send(new orderMail($data));

        //end send email
		
		//insert data in orderitems table
        $carts = Cart::content();
        foreach ($carts as $cart ) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        //product stock decrement
        foreach($carts as $pro)
		{
            Product::where('id',$pro->id)->decrement('product_qty',$pro->qty);
        }

        if (Session::has('coupon')) 
		{
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification=array(
            'message'=>'Your Order Place Success',
            'alert-type'=>'success'
        );
		
        return Redirect()->route('user.dashboard')->with($notification);

    }
	
	
	
}
