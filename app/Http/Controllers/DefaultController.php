<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Article;
use App\Http\Controllers\Controller;


class DefaultController extends Controller
{
    public function home(Request $request){
        if(isset($request->order)){

        } else {
            $request->order = "default";
        }
        $articles = Article::with('user', 'category')->withOrder($request->order)->paginate(20);
        return view("main-pages.home", compact('articles'));
    }

    public function category($id){
        $articles = Article::with('user')->where('category_id', '=', $id)->recent()->paginate(20);
        $categories = Category::all();
        return view('main-pages.category', compact('articles', 'categories', 'id'));
    }

    public function my_follow(){
        $user = Auth::user();
        $user_ids = $user->followings->pluck('id')->toArray();

        $articles = Article::whereIn('user_id', $user_ids)
                                    ->with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(20);

        return view('main-pages.my_follow', compact('articles'));
    }

    public function my_collect(){
        $user = Auth::user();
        $article_ids = $user->collected_articles->pluck('id')->toArray();

        $articles = Article::whereIn('id', $article_ids)
                                    ->with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(20);

        return view('main-pages.my_collect', compact('articles'));
    }
}
