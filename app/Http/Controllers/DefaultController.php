<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Notifications\Refunded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Article;
use App\Models\Banner;
use App\Http\Controllers\Controller;


class DefaultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['home', 'category']);
    }

    public function home(Request $request){
        $articles = Article::withOrder($request->order)->where('work_or_tutorial', '=', '0')->paginate(20);
        $order = $request->order;
        if(!empty(Banner::first())){
            //  为了bootstrap 的轮播图，需要手动设置第一张轮播
            $first_banner = Banner::first();
            $rest_banners = Banner::where('id', '!=', $first_banner->id)->get();
            return view("main-pages.home", compact('articles', 'order', 'first_banner', 'rest_banners', 'type'));
        }
        //  防止最初没有banner时页面无法显示
        else{
            return view("main-pages.home", compact('articles', 'order', 'type'));
        }

    }

    public function category($id, Request $request){
        $order = $request->order;
        $articles = Article::withOrder($order)->where('category_id', '=', $id)->paginate(20);
        $categories = Category::all();
        return view('main-pages.category', compact('articles', 'categories', 'id', 'order'));
    }

    public function my_follow(Request $request){
        $user = Auth::user();
        $user_ids = $user->followings->pluck('id')->toArray();

        $order  = $request->order;
        $articles = Article::withOrder($order)->whereIn('user_id', $user_ids)->paginate(20);

        return view('main-pages.my_follow', compact('articles', 'order'));
    }

    public function my_collect(Request $request){
        $user = Auth::user();
        $article_type = $request->type;
        switch ($article_type){
            case 'tutorial':{
                $articles = $user->collected_articles()->with('user')->where('work_or_tutorial', '1')->orderBy('created_at', 'desc')->paginate(20);
                break;
            }
            case 'work':{
                $articles = $user->collected_articles()->with('user')->where('work_or_tutorial', '0')->orderBy('created_at', 'desc')->paginate(20);
                break;
            }
            default:
        }
        //  用于article_panel中卡片的显示
        //  默认是default显示默认卡片，collections设置为收藏卡片
        $type = 'collections';

        return view('main-pages.my_collect', compact('articles', 'type', 'article_type'));
    }

    public function my_purchased(){
        $user = Auth::user();
        $articles = $user->purchased_articles()->where('work_or_tutorial', '=', 0)->with('user')->paginate(20);

        return view('main-pages.my_purchased', compact('articles'));
    }
}
