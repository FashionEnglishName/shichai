<?php

namespace App\Models;

use App\Notifications\AuthorHasMissed;
use App\Notifications\Missed;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        return $this->belongsToMany(Article::class, 'collections', 'user_id', 'article_id')->withTimestamps();
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

//        //更新关系表的created_at
//        foreach ($article_ids as $article_id){
//            DB::update('update collections set created_at = ? where article_id = ?', [Carbon::now(), $article_id]);
//        }
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
        return $this->belongsToMany(Article::class, "purchases", "user_id", "article_id")->withPivot('firewood_count')->withTimestamps();
    }

    public function purchase($article_id, $firewood){
        $article = Article::find($article_id);

            $author = $article->user;
            //  判断user的余额是否足够
            if ($this->firewood_count - $firewood >= 0){
                $article->firewood_count += $firewood;
                $this->firewood_count -= $firewood;
                if ($article->tutorial_id) {
                    $tutorial = Article::find($article->tutorial_id); //是作品，且有教程，就增加对应教程的firewood，且增加作者的firewood
                    $tutorial->firewood_count += $firewood;
                    $author->firewood_count += $firewood;
                    $tutorial->save();
                    $returnArray =  [
                        'status' => 1,//该文章已有教程，即将跳转
                        'msg' => $article->tutorial_id
                    ];
                } else {
                    if ($article->is_assigned){ // 判断article的tutorial是否正在创作，在创作，就增加文章firewood，且增加作者的firewood
                        $author->firewood_count += $firewood;
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


                $article->save();
                $this->save();
                $author->save();
                if($this->purchased_articles->where('id', '=', $article_id)->first()){
                    $original_firewood = $this->purchased_articles->where('id', '=', $article_id)->first()->pivot->firewood_count;
                } else {
                    $original_firewood = 0;
                }
                $this->purchased_articles()->sync([$article_id => ['firewood_count' => $firewood + $original_firewood]], false);

            }else{
                $returnArray = [
                    'status' => 4,//余额不足
                    'msg' => ''//route()->back()
                ];
            }

            return $returnArray;

    }

    //  购买者可以refund
    public function refund($article_id){
        $article = Article::find($article_id);
        $firewood_sum = 0;
        foreach($article->purchaser->where('id', '=', $this->id) as $item){
            $firewood_sum += $item->pivot->firewood_count;
        }
        $this->purchased_articles()->detach([$article_id]);
        $this->firewood_count += $firewood_sum;
        $this->save();
        $article->firewood_count -= $firewood_sum;
        $article->save();
    }

    //  作者会missDeadline
    public function missDeadline($article){
//        $article_firewood_change = $article->firewood_count;
        $author = $article->user;
        $author->notify(new Missed($article, $author));
        foreach($article->purchaser as $purchaser){
            $purchaser->notify(new AuthorHasMissed($article, $author));
            $user_firewood_change = $purchaser->firewood_count + $purchaser->pivot->firewood_count;
//            $article_firewood_change -= $article->pivot->firewood_count;
            DB::table('users')->where('id', $purchaser->id)->update(['firewood_count' => $user_firewood_change]);
        }
        $all_purchaser_ids = $article->purchaser->pluck('id')->toArray();
        $article->purchaser()->detach($all_purchaser_ids);
        DB::table('articles')->where('id', $article->id)->update(['firewood_count' => 0, 'is_assigned' => 0]);
    }

    public function setPasswordAttribute($value){
        if(empty($value)){
            return ;
        }
        if(strlen($value) != 60){
            $value = bcrypt($value);
        }
        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($path){
        if(! starts_with($path, 'http')){
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }
}


