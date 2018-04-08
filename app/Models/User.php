<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function unFollow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }

        foreach($user_ids as $user_id){
            $user = User::find($user_id);
            $user->follower_count -= 1;
            $user->save();
        }

        $this->following_count -= 1;
        $this->save;

        $this->followings()->detach($user_ids, false);
    }

    public function isFollowing($user_id){
        return $this->followings->contains($user_id);
    }
}
