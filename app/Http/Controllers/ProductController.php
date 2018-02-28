<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use App\Product;

class ProductController extends Controller
{
    public function getBarcode(Request $request){
        $id=$request['getBarcode'];
        if($id) {
            $pds = Product::whereIn('id', $id)->get();
            return view('products.barcode')->with(['pds' => $pds]);
        }else{
            return redirect()->back();
        }
    }
    public function getCategory(){
        $cats=Cat::OrderBy('id', 'desc')->paginate("10");
        return view ('products.categories')->with(['cats'=>$cats]);
    }
    public function postNewCat(Request $request){
        $cat=new Cat();
        $cat->cat_name=$request['cat_name'];
        $cat->save();
        return redirect()->back();

    }
    public function getNewProduct(){
        $cats=Cat::all();
        return view ('products.new-product')->with(['cats'=>$cats]);
    }
    public function postNewProduct(Request $request){
        $this->validate($request,[
        'name'=>'required',
            'qty'=>'required',
            'buy_price'=>'required',
            'sale_price'=>'required',
            'cat_id'=>'required',

        ]);

        $pd=new Product();
        $pd->name=$request['name'];
        $pd->buy_price=$request['buy_price'];
        $pd->sale_price=$request['sale_price'];
        $pd->qty=$request['qty'];
        $pd->barcode=rand(000000, 999999);
        $pd->cat_id=$request['cat_id'];
        $pd->save();
        return redirect()->back();
    }
    public function getProducts(){
        $pds=Product::OrderBy('id', 'desc')->get();
        return view ('products.product')->with(['pds'=>$pds]);
    }
}
