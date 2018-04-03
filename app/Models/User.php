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
        'name', 'email', 'password', 'age', 'gender', 'province_id', 'city_id', 'occupation_id', 'fan_count', 'follow_count', 'work_count', 'tutorials_count', 'avatar'
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
}
