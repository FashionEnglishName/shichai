<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Followed;
use App\Models\User;

class FollowersController extends Controller
{
    public function store($id){
        Auth::user()->follow($id);

        $user = User::find($id);
        $user->notify(new Followed(Auth::user()));

        return redirect()->back();
    }

    public function destroy($id){
        Auth::user()->unfollow($id);

        return redirect()->back();
    }
}
