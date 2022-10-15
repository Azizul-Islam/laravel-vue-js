<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('welcome',compact('products'));
    }


    public function cartStore(Request $request)
    {
        if(!$request->get('product_id')){
            return [
                'message' => 'Cart items returned',
                'items' => Cart::where('user_id',auth()->user()->id)->sum('quantity'),

            ];
        }
        $product = Product::findOrFail($request->product_id);
        $productFoundInCart = Cart::where(['product_id'=>$product->id,'user_id'=>$request->user_id])->pluck('id');
        if($productFoundInCart->isEmpty()){

            $cart = Cart::create([
                'product_id' => $product->id,
                'user_id' => $request->user_id,
                'quantity' => 1,
                'price' => $product->sale_price
            ]);
        }
        else {
            $cart = Cart::where(['product_id'=>$product->id,'user_id'=>$request->user_id])->increment('quantity');
        }
        if($cart) {
            return [
                'message' => 'Cart updated',
                'items' => Cart::where('user_id',auth()->user()->id)->sum('quantity'),

            ];
        }
    }


    public function checkout()
    {
        return view('checkout');
    }

    public function checkoutGetItems()
    {
        $cartItems = Cart::with('products')->where('user_id',auth()->user()->id)->get();
        $finalData = [];
        $amount = 0;
        if(isset($cartItems)){
            foreach($cartItems as $cartItem){
                if($cartItem->products){
                    foreach($cartItem->products as $cartProduct){
                        if($cartProduct->id == $cartItem->product_id){
                            $finalData[$cartItem->product_id]['id'] = $cartProduct->id;
                            $finalData[$cartItem->product_id]['name'] = $cartProduct->name;
                            $finalData[$cartItem->product_id]['sale_price'] = $cartItem->price;
                            $finalData[$cartItem->product_id]['quantity'] = $cartItem->quantity;
                            $finalData[$cartItem->product_id]['total'] = $cartItem->price * $cartItem->quantity;
                            $amount += $cartItem->price * $cartItem->quantity;
                            $finalData['totalAmount'] = $amount;
                        }
                    }
                }
            }

        }
        return response()->json($finalData);
    }
}
