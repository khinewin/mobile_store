@extends('admin.layouts.app')

@section('title') Products My App @stop

@section('content')
    <div id="wrapper">
        @include('admin.layouts.nav_bar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-google-wallet"></i> Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <form method="post" action="{{route('get-barcode')}}" target="_blank">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-barcode"></i> Generate Barcode</button>
                    <br>
                <table class="table" id="MyProduct">
                    <thead>
                        <tr class="text-primary">
                            <td>ID</td>
                            <td>Check For Barcode</td>
                            <td>Name</td>
                            <td>Buying Price</td>
                            <td>Sale Price</td>
                            <td>Qty</td>
                            <td>Barcode</td>
                            <td>Category</td>
                        </tr>
                    </thead>
                    @foreach($pds as $pd)
                        <tr class="text-info">
                            <td>{{$pd->id}}</td>
                            <td><input type="checkbox" name="getBarcode[]" value="{{$pd->id}}"></td>
                            <td>{{$pd->name}}</td>
                            <td>{{$pd->buy_price}}</td>
                            <td>{{$pd->sale_price}}</td>
                            <td>{{$pd->qty}}</td>
                            <td>{{$pd->barcode}}</td>
                            <td>{{$pd->cat->cat_name}}</td>
                        </tr>
                        @endforeach
                </table>
                    {{csrf_field()}}
                </form>
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>

@endsection
