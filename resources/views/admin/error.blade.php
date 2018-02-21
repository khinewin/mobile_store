@extends('admin.layouts.app')

@section('title') Error My App @stop

@section('content')
    <div id="wrapper">
        @include('admin.layouts.nav_bar')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-danger"><i class="fa fa-warning"></i> Error</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @yield('section')
                <div class="text-danger text-center"><h2><i class="fa fa-warning"></i> You don't have permission to access this page.</h2></div>

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
