<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable {
        notify as protected beforeNotify;
    }
    use HasRoles;

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
        $this->following_count += count($user_ids);
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

    //  添柴
    public function purchased_articles(){
        return $this->belongsToMany(Article::class, "purchases", "user_id", "article_id");
    }

    public function purchase($article_id){
        if(!is_array($article_id)){
            $article_ids = compact('article_ids');
        }

        $article = Article::find($article_id);
        //  判断user的余额是否足够
        if ($this->firewood_count - 3 >= 0){
            $article->firewood_count += 3;
            $this->firewood_count -= 3;
            if($article->work_or_tutorial){
                $work = Article::find($article->work_id); //是教程就增加对应作品的firewood
                $work->firewood_count += 3;
                $work->save();
                $returnArray = [
                    'status' => 5,  //请查看教程
                    'msg' => ''
                ];
            } else {
                if ($article->tutorial_id) {
                    $tutorial = Article::find($article->tutorial_id); //是作品，且有教程，就增加对应教程的firewood
                    $tutorial->firewood_count += 3;
                    $tutorial->save();
                    $returnArray =  [
                        'status' => 1,//该文章已有教程，即将跳转
                        'msg' => $article->tutorial_id
                    ];
                } else {
                    if ($article->is_assigned){ // 判断article的tutorial是否正在创作
                        $returnArray = [
                            'status' => 2,//该文章的教程正在创作，请耐心等待
                            'msg' => ''//$article->assigned_at->diffForHuman()
                        ];
                    } else {
                        //不是教程，也没有在创作
                        $returnArray = [
                            'status' => 3,//您的柴火已添加到柴堆，作者会尽赶来
                            'msg' => ''//route()->back()
                        ];
                    }
                }
            }

            $article->save();
            $this->save();
            $this->purchased_articles()->sync($article_id, false);

        }else{
            $returnArray = [
                'status' => 4,//余额不足
                'msg' => ''//route()->back()
            ];
        }

        return $returnArray;
    }
}
