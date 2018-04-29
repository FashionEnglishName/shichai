<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Notifications\Purchased;
use App\Notifications\Assigned;
use App\Notifications\Refunded;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Policies\UserPolicy;

class PurchasesController extends Controller
{
    public function store($id, Request $request){
        $user = Auth::user();
        $received_array = $user->purchase($id, (int)$request->firewood);

        if ($received_array['status'] != 4){
            $article = Article::find($id);
            if($article->tutorial_id){
                $tutorial = $article->tutorial;
                $tutorial->hasSamePurchaser($article);
            }

            $author = User::find($article->user_id);

            $author->notify(new Purchased($article, $user));
        }

        switch ($received_array['status']){
            case 1 :
                return redirect()->route('articles.show', $received_array['msg'])->with('warning', '该文章已有教程，已为您跳转');
                break;
            case 2 :
                return redirect()->back()->with("warning", "该文章的教程正在创作，请耐心等待");
                break;
            case 3 :
                return redirect()->back()->with("success", "您的柴火已添加到柴堆，作者会尽赶来");
                break;
            case 4 :
                return redirect()->back()->with("error", "柴火不足，右上角充值");
                break;
            default :
                return redirect()->back()->with("error", "未知错误，什么都没有发生");
        }
    }

    public function ignite($id){
        $article = Article::find($id);
        $article->is_assigned = 1;
        $article->assigned_at = Carbon::now();
        $article->save();
        $users = $article->purchaser;

        foreach($users as $user){
            $user->notify(new Assigned($article, Auth::user()));
        }

        return redirect()->back()->with('success', '已通知添柴人，请于15天内提交教程');
    }

    public function destroy($id){
        $article = Article::find($id);
        $this->authorize('refund', $article);

        $user = Auth::user();
        $user->refund($id);

        $author = $article->user;
        $author->notify(new Refunded($user, $article));

        return redirect()->back()->with('success', '已成功取回柴火');
    }
}
