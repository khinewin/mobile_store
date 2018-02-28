@extends('admin.layouts.app')

@section('title') Barcode My App @stop

@section('content')

    <div class="container">
        <div class="row" style="margin-top: 50px">
            @foreach($pds as $pd)
                <div class="col-md-3">
                    <p class="text-center">Item Name : {{$pd->name}}</p>
                    <p class="text-center"><img src="data:image/png;base64, {{DNS1D::getBarcodePNG($pd->barcode, 'C93')}} ")/></p>
                    <p class="text-center">Price : {{$pd->sale_price}}</p>
                </div>
                @endforeach
        </div>
    </div>

@endsection
