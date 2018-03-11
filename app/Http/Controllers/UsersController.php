<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function store(Request $request){
//        $this->validate($request,[
//           'name' => 'required|max:50',
//            'email' => 'required|email|unique:users|max:255',
//            'password' => 'required|confirmed|min:6'
//        ]);
        dd($request->all());
    }
}
