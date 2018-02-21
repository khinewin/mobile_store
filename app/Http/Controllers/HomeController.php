<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function getDashboard(){
        return view ('admin.dashboard');
    }
    public function getProfile(){
        $user=Auth::User();
        return view ('admin.profile')->with(['user'=>$user]);
    }
    public function postUploadUserImage(Request $request){
        $this->validate($request,[
            'user_image'=>'required | mimes:jpeg,jpg,png'
        ]);
        $image_name=Auth::User()->name;
        $image_file=$request->file('user_image');

        Storage::disk('user_image')->put($image_name, file::get($image_file));
        return redirect()->back();

    }

    public function getUserImage($file_name){
        $file=Storage::disk('user_image')->get($file_name);
        return response($file, 200);
    }
    public function getEmployees(){
        $users=User::all();
        $roles=Role::all();
        return view ('admin.employees')->with(['users'=>$users])->with(['roles'=>$roles]);
    }
    public function postUpdateUserRole(Request $request){
        $id=$request['id'];
        $user_role=$request['user_role'];
        $user=User::where('id', $id)->first();
        $user->syncRoles($user_role);
        return redirect()->back();
    }
    public function postRemoveUser(Request $request){
        $id=$request['id'];
        $user=User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
