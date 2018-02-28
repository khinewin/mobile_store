@extends('admin.layouts.app')

@section('title') Detail My App @stop

@section('content')
    <div id="wrapper">
        @include('admin.layouts.nav_bar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-share-square-o"></i> Detail</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
               @foreach($orders as $order)
                   <div class="panel panel-primary">
                       <div class="panel-heading">Customer : @if($order->customer) {{$order->customer}}@else Customer @endif | Waiter : {{$order->user->name}} <span class="pull-right">Date : {{date('d-m-Y h:i A', strtotime($order->created_at))}}</span></div>
                       <div class="panel-body">
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
                       </div>
                   </div>
                   @endforeach
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
