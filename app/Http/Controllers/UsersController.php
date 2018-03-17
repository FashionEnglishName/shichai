<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth',[
            'except' => ['store', 'create']
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
           'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);
        return response()->json($user);
//        return redirect("users/{$user->id}");
    }

    public function show($id){
        $this->authorize('update', User::find($id));

        $user = User::find($id);
        return view("users.show-and-edit", compact('user'));
    }

    public function update_info(Request $request){
        $this->validate($request,[
            'name' => 'required|max:50'
        ]);

        $this->authorize('update', User::find($request->id));
        $isUpdated = User::find($request->id)->update([
            'name' => $request->name
        ]);

        return response()->json($isUpdated);
    }

    public function update_password(Request $request){
        $this->validate($request,[
            'password' => 'required|confirmed|min:6'
        ]);

        $this->authorize('update', User::find($request->id));
        $isUpdated = User::find($request->id)->update([
            'password' => bcrypt($request->password)
        ]);

        Auth::logout();
        return response()->json($isUpdated);
    }
}
