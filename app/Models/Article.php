<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable =['title', 'content', 'category_id', 'updated_at', 'collection_count', 'cover'];

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeWithOrder($query, $order){
        switch($order) {
            case 'recent':
                $query = $this->recent();
                break;

            default:
                $query = $this->recentReplied();
                break;
        }
        return $query->with('user', 'category');
    }

    public function scopeRecent($query){
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeRecentReplied($query){
        return $query->orderBy('updated_at', 'desc');
    }

    //  收藏
    public function collectors(){
        return $this->belongsToMany(User::class, 'collections', 'article_id', 'user_id')->withTimestamps();
    }

    //  添柴
    public function purchaser(){
        return $this->belongsToMany(User::class, "purchases", "article_id", "user_id")->withPivot('firewood_count')->withTimestamps();
    }

    //  教程
    public function work(){
        return $this->hasOne(Article::class, "id", "work_id");
    }

    public function tutorial(){
        return $this->hasOne(Article::class, "id", "tutorial_id");
    }

    public function hasSamePurchaser(Article $work){
        $user_ids = $work->purchaser->pluck('id')->toArray();
        $this->purchaser()->sync($user_ids, false);
    }

    //  banner
    public function banner(){
        return $this->belongsTo(Banner::class);
    }
}
