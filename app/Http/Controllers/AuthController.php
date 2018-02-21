<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function getError(){
        return view ('admin.error');
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('/');
    }
    public function getLogin(){
        return view ('admin.auth.login');
    }
    public function postLogin(Request $request){
        $name=$request['name'];
        $password=$request['password'];
        $this->validate($request,[
            'name'=>'required|exists:users',
            'password'=>'required'
        ]);
        if(Auth::attempt(['name'=>$name, 'password'=>$password])){
                return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('err','Authentication failed.');
        }
    }

    public function getRegister(){
        $roles=Role::all();
        return view ('admin.auth.register')->with(['roles'=>$roles]);
    }
    public function postRegister(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:users',
            'password'=>'required|min:6',
            'password_again'=>'required|same:password',
            'user_role'=>'required'
        ]);
        $user=new User();
        $user->name=$request['name'];
        $user->password=bcrypt($request['password']);
        $user->save();
        $user->syncRoles($request['user_role']);
        return redirect()->back()->with('info', "The user account have been created.");
    }
}
