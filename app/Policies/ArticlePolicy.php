<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function canRead(User $currentUser, Article $article){
        if($currentUser == $article->user){
            return true;
        } else {
            if($article->work_or_tutorial){
                return $currentUser->purchased_articles->pluck('id')->contains($article->id);
            } else {
                return true;
            }
        }
    }

    public function refund(User $currentUser, Article $article){
        return $currentUser->purchased_articles->pluck('id')->contains($article->id);
    }

    public function isAuthor(User $currentUser, Article $article){

    }

}
