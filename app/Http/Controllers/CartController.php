<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Session;
use App\Order;
use Auth;

class CartController extends Controller
{
    public function postCheckout(Request $request){

        $customer=$request['customer'];
        $user_id=Auth::User()->id;
        $amount_tendered=Session::get('a_t');
        $cart=Session::get('cart');
        $od=new Order();
        $od->customer=$customer;
        $od->user_id=$user_id;
        $od->amount_tendered=$amount_tendered;
        $od->cart=serialize($cart);
        $od->save();

        Session::forget('cart');
        Session::forget('a_t');

        $id=$od->id;
        $orders=Order::where('id', $id)->get();
        $orders->transform(function ($order, $key){
           $order->cart=unserialize($order->cart);
           return $order;
        });

        return view ('checkout')->with(['orders'=>$orders]);


    }
    public function postEditPayment(Request $request){
        $amount_tendered=$request['amount_tendered'];
        Session::put('a_t', $amount_tendered);
        return redirect()->back();
    }
    public function getSale(){
        if(Session::has('cart')){
            $pds = Product::all();
            $cart=Session::get('cart');
            return view('products.sale')->with(['pds' => $pds])->with(['carts'=>$cart->items])->with(['totalAmount'=>$cart->totalAmount]);
        }else {
            $pds = Product::all();
            return view('products.sale')->with(['pds' => $pds]);
        }
    }
    public function getRemoveItem($id){
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $cart->remove($id);
        if(count($cart->items)){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
            Session::forget('a_t');
        }
        return redirect()->back();
    }
    public function postAddToCart(Request $request){
        $sale_item=$request['sale_item'];
        $pd=Product::where('name', $sale_item)->orWhere('barcode', $sale_item)->first();

        if($pd){
            if($pd->qty >0){

                $oldCart=Session::has('cart') ? Session::get('cart') :null;
            $cart=new Cart($oldCart);
            $cart->add($pd, $pd->id);
            Session::put('cart', $cart);

            $oldQty=$pd->qty;
            $newQty=$oldQty-1;
            $pd->qty=$newQty;
            $pd->update();

            return redirect()->back();


            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }

    }
}
