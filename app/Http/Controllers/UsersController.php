<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
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

//        $user->email = $request->get('email');
//        $user->name = $request->get('name');
//        $user->password = $request->get('password');
//        $user->save();

        Auth::login($user);
        return response()->json($user);
//        return redirect("users/{$user->id}");
    }

    public function show($id){
        $user = User::find($id);
        return view("main-pages.user", compact('user'));
    }
}
