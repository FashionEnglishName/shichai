<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Article;
use App\Models\Banner;
use App\Http\Controllers\Controller;


class DefaultController extends Controller
{
    public function home(Request $request){
        $articles = Article::withOrder($request->order)->paginate(20);
        $order = $request->order;
        $first_banner = Banner::first();
        $rest_banners = Banner::where('id', '!=', $first_banner->id)->get();
        return view("main-pages.home", compact('articles', 'order', 'first_banner', 'rest_banners', 'type'));
    }

//    public function home_tutorials(){
//        $articles = Article::with('user', 'category')->where('work_or_tutorial', '=', '1')->orderBy('updated_at', 'desc')->paginate(20);
//        return view("main-pages.home_tutorials", compact('articles'));
//    }

    public function category($id){
        $articles = Article::with('user')->where('category_id', '=', $id)->recent()->paginate(20);
        $categories = Category::all();
        return view('main-pages.category', compact('articles', 'categories', 'id'));
    }

    public function my_follow(Request $request){
        $user = Auth::user();
        $user_ids = $user->followings->pluck('id')->toArray();

        $order  = $request->order;
        $articles = Article::withOrder($order)->whereIn('user_id', $user_ids)
                                    ->paginate(20);

        return view('main-pages.my_follow', compact('articles', 'order'));
    }

    public function my_collect(){
        $user = Auth::user();

        $articles = $user->collected_articles()->with('user')->orderBy('created_at', 'desc')->paginate(20);

        $type = 'collections';

        return view('main-pages.my_collect', compact('articles', 'type'));
    }

    public function my_purchased(){
        $user = Auth::user();
        $articles = $user->purchased_articles()->with('user')->paginate(20);

        return view('main-pages.my_purchased', compact('articles'));
    }
}
