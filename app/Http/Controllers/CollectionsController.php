<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Notifications\Collected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionsController extends Controller
{
    public function store($id){
        $user = Auth::user();
        $user->collect($id);

        $article = Article::find($id);
        $notified_user = $article->user;
        $notified_user->notify(new Collected($user, $article));

        return redirect()->back()->with("success", "已成功收藏该文章");
    }

    public function destroy($id){
        $user = Auth::user();
        $user->uncollect($id);

        return redirect()->back()->with('success', '已成功取消收藏');
    }
}
