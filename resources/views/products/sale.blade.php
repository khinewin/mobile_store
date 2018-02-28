@extends('admin.layouts.app')

@section('title') Sale My App @stop

@section('content')
    <div id="wrapper">
        @include('admin.layouts.nav_bar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-share-alt"></i> Sale</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
               <div class="col-md-6">
                   <div class="panel panel-primary">
                       <div class="panel-heading">Scan Barcode or Enter Item name to sale.</div>
                       <div class="panel-body">
                           <form id="sale_form" method="post" action="{{route('add_to_cart')}}">
                               <div class="form-group">
                                   <input autofocus type="search" list="sale-list" name="sale_item" id="sale_item" class="form-control" placeholder="Scan Barcode or Enter Item name to sale.">
                                   <datalist id="sale-list">
                                       @foreach($pds as $pd)
                                       <option value="{{$pd->name}}"></option>
                                        @endforeach
                                   </datalist>
                               </div>
                               {{csrf_field()}}
                           </form>
                       </div>
                   </div>

               </div>
                <div class="col-md-6">
               <div class="panel panel-primary">
                   <div class="panel-heading"><i class="fa fa-shopping-cart"></i> Sale Cart</div>
                   <div class="panel-body">
                       <table class="table">
                           <tr>
                               <td>Name</td>
                               <td>Price</td>
                               <td>Qty</td>
                               <td>Amount</td>
                           </tr>
                           @if(Session::has('cart'))
                           @foreach($carts as $cart)
                               <tr>
                                   <td>{{$cart['item']['name']}}</td>
                                   <td>{{$cart['item']['sale_price']}}</td>
                                   <td>{{$cart['qty']}}</td>
                                   <td>{{$cart['price']}}</td>
                                   <td><a href="{{route('remove.item',['id'=>$cart['item']['id']])}}" class="text-danger"><i class="fa fa-trash"></i></a></td>
                               </tr>
                               @endforeach
                           @endif
                           <tr>
                               <td>Total Amount</td>
                               <td>@if(Session::has('cart')){{$totalAmount}}@endif</td>
                           </tr>
                               <tr>
                                   <td>Payment Total</td>
                                   <td>@if(Session::has('a_t')) {{Session::get('a_t')}} @endif</td>
                               </tr>
                               <tr>
                                   <td>Amount Due</td>
                                   <td>@if(Session::has('cart')) @if(Session::has('a_t')) {{Session::get('a_t')-$totalAmount}} @endif @endif</td>
                               </tr>

                       </table>
                       <div class="row">

                           <div class="col-md-6">
                           <form method="post" action="{{route('edit_payment')}}">
                           <div class="form-group">
                               <label for="amount_tendered" class="control-label">Amount Tendered</label>
                               <input type="text" name="amount_tendered" class="form-control" value="@if(Session::has('cart')) {{$totalAmount}} @endif">

                               {{csrf_field()}}
                               <button type="submit" class="btn btn-success btn-block btn-sm">Add Payment</button>
                           </div>
                           </form>
                           </div>
                           <div class="col-md-6">
                               @if(Session::has('cart'))
                                   @if(Session::has('a_t'))
                                       <form method="post" action="{{route('checkout')}}" target="_blank">
                                           <div class="form-group">
                                               <label for="customer" class="control-label">Customer Name</label>
                                               <input type="text" name="customer" id="customer" class="form-control">
                                           </div>
                                           <button type="submit" class="btn btn-primary btn-lg btn-block">Checkout</button>
                                           {{csrf_field()}}
                                       </form>
                                       @endif
                                   @endif

                           </div>

                       </div>
                       <br>
                       <a href="{{route('sale')}}" class="btn btn-primary btn-block">New Sale</a>


                   </div>

               </div>
                </div>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
