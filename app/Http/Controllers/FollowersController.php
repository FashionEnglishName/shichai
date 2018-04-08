<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function store($id){;
        Auth::user()->follow($id);

        return redirect()->back();
    }

    public function destroy($id){
        Auth::user()->unFollow($id);

        return redirect()->back();
    }
}
