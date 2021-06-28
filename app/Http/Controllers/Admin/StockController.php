<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //index
    public function index(){
        $products = Product::latest()->get();
        return view('admin.stock.index',compact('products'));
    }

    //stock edit
    public function edit($id){
       $product = Product::findOrFail($id);
       return view('admin.stock.edit',compact('product'));
    }

    //update
    public function update(Request $request,$id){
        Product::findOrFail($id)->update(['product_qty' => $request->product_qty]);

        $notification=array(
            'message'=>'Stock Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('product.stock')->with($notification);
    }
}
