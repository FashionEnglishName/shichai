<?php

namespace App\Observers;

use App\Models\Article;
use App\Jobs\MissDeadline;
use Carbon\Carbon;

class ArticleObserver
{
    public function saving(Article $article){
        $article->excerpt = make_excerpt($article->title);
    }

    public function updated(Article $article){
        if($article->is_assigned == 1 && $article->tutorial_id == null){
            MissDeadline::dispatch($article)
                ->delay(Carbon::now()->addMinutes(1));
        }
    }

}