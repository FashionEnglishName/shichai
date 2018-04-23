<?php

namespace App\Observers;

use App\Models\Banner;
use App\Models\Article;

class BannerObserver {
    public function saved(Banner $banner){
        $banner_id = $banner->id;
        $article = $banner->article;

        $article->banner_id = $banner_id;
        $article->save();
    }

    public function deleting(Banner $banner){
        $banner_id = $banner->id;
        $article = $banner->article;

        $article->banner_id = null;
        $article->save();
    }


}