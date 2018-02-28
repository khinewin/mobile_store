<?php

namespace App;
use App\Product;

class Cart
{
    public $items;
    public $totalAmount=0;
    public $totalQty=0;
    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items=$oldCart->items;
            $this->totalQty=$oldCart->totalQty;
            $this->totalAmount=$oldCart->totalAmount;
        }else{
            $this->items=null;
        }
    }
    public function add($item, $id){
        $storeItem=['qty'=>0, 'item'=>$item, 'price'=>$item->sale_price];
        if($this->items){
            if(array_key_exists($id , $this->items)){
                $storeItem=$this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['price']=$storeItem['qty'] * $item->sale_price;
        $this->items[$id]=$storeItem;
        $this->totalQty++;
        $this->totalAmount +=$item->sale_price;
    }
    public function remove($id){
       $cQty=$this->items[$id]['qty'];
        $pd=Product::where('id', $id)->first();
        $dbQtq=$pd->qty;
        $newQty=$cQty+$dbQtq;
        $pd->qty=$newQty;
        $pd->update();
        $this->totalAmount-=$this->items[$id]['item']['sale_price'];
       unset($this->items[$id]);

    }
}
