<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable {
        notify as protected beforeNotify;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'age', 'gender', 'province_id', 'city_id', 'occupation_id',  'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function occupation(){
        return $this->belongsTo(Occupation::class);
    }

    //  关注
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function follow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }

        foreach($user_ids as $user_id){
            $user = User::find($user_id);
            $user->follower_count += 1;
            $user->save();
        }
        $this->following_count += 1;
        $this->save();
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }

        foreach($user_ids as $user_id){
            $user = User::find($user_id);
            $user->follower_count -= 1;
            $user->save();
        }

        $this->following_count -= 1;
        $this->save();

        $this->followings()->detach($user_ids, false);
    }

    public function isFollowing($user_id){
        return $this->followings->contains($user_id);
    }

    //  通知
    public function notify($instance){
        if($this->id == Auth::id()){
            return;
        }

        $this->notification_count += 1;
        $this->save();
        $this->beforeNotify($instance);
    }

    public function markAsRead(){
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    //  收藏
    public function collected_articles(){
        return $this->belongsToMany(Article::class, 'collections', 'user_id', 'article_id');
    }

    public function collect($article_ids){
        if(!is_array($article_ids)){
            $article_ids = compact('article_ids');
        }

        foreach ($article_ids as $article_id){
            $article = Article::find($article_id);
            $article->collection_count += 1;
            $article->save();
        }

        $this->collected_articles()->sync($article_ids, false);
    }

    public function uncollect($article_ids){
        if(!is_array($article_ids)){
            $article_ids = compact('article_ids');
        }

        foreach ($article_ids as $article_id){
            $article = Article::find($article_id);
            $article->collection_count -= 1;
            $article->save();
        }

        $this->collected_articles()->detach($article_ids);
    }

    public function isCollecting($article_id){
        return $this->collected_articles->contains($article_id);
    }
}
