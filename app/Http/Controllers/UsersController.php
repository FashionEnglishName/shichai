<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;

class UsersController extends Controller
{
    //
    public function store(Request $request){

        $this->validate($request,[
           'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = new User();
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->password = $request->get('password');
        $user->save();

        return response()->json($user);
//        return redirect("users/{$user->id}");
    }

    public function show($id){
        $user = User::find($id);
        return view("main-pages.user", compact('user'));
    }
}
