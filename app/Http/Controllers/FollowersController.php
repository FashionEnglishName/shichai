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

        return redirect()->back()->with('success', '您已成功关注此用户');
    }

    public function destroy($id){
        Auth::user()->unfollow($id);

        return redirect()->back()->with('success', '您已成功取关此用户');
    }

    public function followings_list(){
        $user = Auth::user();
        $followings = $user->followings()->paginate(20);

        return view('follows.list', compact('followings'));
    }
}
