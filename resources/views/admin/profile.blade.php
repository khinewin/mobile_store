@extends('admin.layouts.app')

@section('title') User Profile My App @stop

@section('content')
    <div id="wrapper">
        @include('admin.layouts.nav_bar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-user"></i> User Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @yield('section')
                <div class="row">
                <div class="text-center">
                    <img src="{{route('user-image',['file_name'=>$user->name])}}" alt="No User Image" class="img-thumbnail" style="width: 200px; height: 200px">

                </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <form method="post" action="{{route('user-image.upload')}}" enctype="multipart/form-data">
                            <div class="form-group @if($errors->has('user_image')) has-error @endif">
                                @if($errors->has('user_image')) <span class="help-block">{{$errors->first('user_image')}}</span> @endif
                                <label for="user_img" class="control-label">Select User Image</label>
                                <input type="file" name="user_image" id="user_image" class="form-control" style="height: auto">
                                <button type="submit" class="btn btn-primary btn-block">Upload</button>
                            </div>
                            {{csrf_field()}}

                        </form>
                    </div>
                </div>



            </div>
            <br>
            <div class="row">



                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-user"></i> Username : {{$user->name}}</li>
                    <li class="list-group-item"><i class="fa fa-user-md"></i> User Role : @if($user->hasRole('Admin'))Administrator @else Employee @endif</li>
                    <li class="list-group-item"><i class="fa fa-clock-o"></i> Created Date : {{date('d-m-Y h:i A', strtotime($user->created_at))}} </li>
                </ul>

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
