<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Province;
use App\Notifications\Refunded;
use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Input;

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
    }

    public function show($id, Request $request){
        $order = $request->order;
        $user = User::find($id);
        $articles = $user->articles()->withOrder($order)->where('user_id', '=', $id)->paginate(20);
        return view("users.show", compact('user', 'articles', 'order'));
    }

    public function update_info(UserRequest $request){
        $user = User::find($request->id);
        $this->authorize('update', $user);

        $user->update($request->all());

        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }

    public function update_avatar($id, Request $request){
        $user = User::find($id);
        $this->authorize('update', $user);

        $data = uploadFileThumbnail($request->imgBase, 'avatars', $id, 200, 200);
        $user->avatar = $data;
        $user->save();
        return response()->json([
            'status' => 'success',
        ]);
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

    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit', compact('user'));
    }

    public function get_cities(Request $request){
        $province_id = $request->first;
        $cities = DB::select("select * from cities where cities.pid = ?", [$province_id]);
        return $cities;
    }

    public function add_firewood(){
        $user = Auth::user();
        $user->firewood_count += 5;
        $user->save();
        return response()->json("成功");
    }

    public function check_firewood(){
        $user = Auth::user();
        return response()->json([
           'firewood' => $user->firewood_count
        ]);
    }

    public function show_followings($id){
        $user = User::find($id);
        $users = $user->followings()->paginate(30);
        $title = "关注的人";
        return view('users.show_follow', compact('title', 'users', 'user'));
    }

    public function show_followers($id){
        $user = User::find($id);
        $users = $user->followers()->paginate(30);
        $title = "我的粉丝";
        return view('users.show_follow', compact('title', 'users', 'user'));
    }
}
