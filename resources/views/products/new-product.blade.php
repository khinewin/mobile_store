@extends('admin.layouts.app')

@section('title') New Product My App @stop

@section('content')
    <div id="wrapper">
        @include('admin.layouts.nav_bar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-plus-circle"></i> New Product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-8">

                    <form method="post" action="{{route('new-product')}}">
                        <div class="form-group">
                            @if($errors->has('name')) {{$errors->first('name')}} @endif
                            <label for="name" class="control-label">Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            @if($errors->has('qty')) {{$errors->first('qty')}} @endif
                            <label for="qty" class="control-label">Qty</label>
                            <input type="text" name="qty" class="form-control">
                        </div>
                        <div class="form-group">
                            @if($errors->has('buy_price')) {{$errors->first('buy_price')}} @endif
                            <label for="buy_price" class="control-label">Buying Price</label>
                            <input type="text" name="buy_price" class="form-control">
                        </div>
                        <div class="form-group">
                            @if($errors->has('sale_price')) {{$errors->first('sale_price')}} @endif
                            <label for="sale_price" class="control-label">Sale Price</label>
                            <input type="text" name="sale_price" class="form-control">
                        </div>


                        <div class="form-group">
                            @if($errors->has('cat_id')) {{$errors->first('cat_id')}} @endif
                            <label for="cat_id" class="control-label">Category</label>
                            <select name="cat_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Save</button>
                        </div>
                        {{csrf_field()}}
                    </form>

                </div>

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
