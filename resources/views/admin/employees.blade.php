@extends('admin.layouts.app')

@section('title') Employees My App @stop

@section('content')
<div id="wrapper">
    @include('admin.layouts.nav_bar')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-users"></i> Employees</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
           <table class="table">
               <thead>
               <tr>
                   <td>User Name</td>

                   <td>User Role</td>
                   <td>Created Date</td>
                   <td>Edit</td>
                   <td>Remove</td>
               </tr>
               </thead>

               @foreach($users as $user)
                   <tr>
                       <td>{{$user->name}}</td>
                       <td>@if($user->hasRole('Admin')) Administrator @else Employee @endif</td>
                       <td>{{date('d-m-Y h:i A', strtotime($user->created_at))}}</td>
                       <td><a href="#" data-toggle="modal" data-target="#e{{$user->id}}"><i class="fa fa-edit"></i></a></td>
                       <!-- Edit User Modal -->
                       <div class="modal fade" id="e{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                               <form method="post" action="{{route('update-user-role')}}">
                                   <input type="hidden" name="id" id="id" value="{{$user->id}}">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Edit User Role | {{$user->name}} (@if($user->hasRole('Admin')) Admin @else Employee @endif) </h4>
                                   </div>
                                   <div class="modal-body">
                                       <div class="form-group">
                                           <label for="name" class="control-label">Username</label>
                                           <input type="text" name="name" id="name" class="form-control" disabled value="{{$user->name}}">
                                       </div>
                                       <div class="form-group">
                                           <label for="user_role" class="control-label">User Role</label>
                                            <select name="user_role" class="form-control">

                                                @foreach($roles as $role)
                                                    <option>{{$role->name}}</option>
                                                    @endforeach
                                            </select>
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





                       <td><a href="#" data-toggle="modal" data-target="#d{{$user->id}}" class="text-danger"><i class="fa fa-trash"></i></a></td>

                       <!-- Remove User Modal -->
                       <div class="modal fade" id="d{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                               <form method="post" action="{{route('post-remove-user')}}">
                                   <input type="hidden" name="id" id="id" value="{{$user->id}}">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel">Confirm Remove</h4>
                                   </div>
                                   <div class="modal-body">
                                       <div class="alert alert-warning"><i class="fa fa-warning"></i> Are you sure want to remove this user account name <strong>{{$user->name}}</strong></div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Remove</button>
                                   </div>
                               </div>
                                   {{csrf_field()}}
                               </form>
                           </div>
                       </div>


                   </tr>
                   @endforeach
           </table>

        </div>
        <!-- /#page-wrapper -->
    </div>
</div>
@endsection
