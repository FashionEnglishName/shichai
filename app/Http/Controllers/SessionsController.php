<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create(request $request){
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ]);

        if(Auth::attempt($credentials, $request->remember)){

            $status = "success";
            return response()->json([
                'status' => $status
            ]);
        } else {
            return response()->json([
                'status' => "error",
                'error' => "抱歉，你的用户名和密码不匹配！",
            ]);
        }

        return;


    }

    public function destroy(){
        Auth::logout();

        session()->flash("success","退出成功");
        return redirect('/');
    }
}
