@extends('admin.layouts.app')

@section('title') Print My App @stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Ko Gyi AUng Mobile</h1>
                <p>Bee Luu Kyun</p>
                <p>09272764923</p>

                @foreach($orders as $order)
                    <p>Customer : @if($order->customer) {{$order->customer}} @else Customer @endif</p>
                    <p>Cashier : {{$order->user->name}}</p>
                    <p>Date : {{date('d-m-Y h:i A', strtotime($order->created_at))}}</p>

                   <table class="table">
                       <tr>
                           <td>Name</td>
                           <td>Price</td>
                           <td>Qty</td>
                           <td>Amount</td>
                       </tr>
                       @foreach($order->cart->items as $item)
                           <tr>
                            <td>{{$item['item']['name']}}</td>
                               <td>{{$item['item']['sale_price']}}</td>
                               <td>{{$item['qty']}}</td>
                               <td>{{$item['price']}}</td>
                           </tr>
                           @endforeach
                       <tr>
                           <td>Total Amount</td>
                           <td>{{$order->cart->totalAmount}}</td>
                       </tr>
                   </table>

                    @endforeach
            </div>
        </div>
    </div>
@endsection
