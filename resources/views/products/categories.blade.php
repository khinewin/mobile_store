@extends('admin.layouts.app')

@section('title') Categories My App @stop

@section('content')
    <div id="wrapper">
        @include('admin.layouts.nav_bar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-list"></i> Categories</h1>
                    <div class="pull-right">
                        <a href="#" data-toggle="modal" data-target="#newCat"><i class="fa fa-plus-circle"></i> New Category</a>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
               <table class="table">
                   <thead>
                   <tr>
                       <td>ID</td>
                       <td>Category Name</td>
                   </tr>
                   </thead>
                   @foreach($cats as $cat)
                       <tr>
                           <td>{{$cat->id}}</td>
                           <td>{{$cat->cat_name}}</td>
                       </tr>
                       @endforeach
               </table>
                {{$cats->links()}}
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>

    <!-- New Category Modal -->
    <div class="modal fade" id="newCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('new_cat')}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cat_name" class="control-label">Category Name</label>
                        <input type="text" name="cat_name" id="cat_name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
                {{csrf_field()}}
            </form>
        </div>
    </div>



@endsection


