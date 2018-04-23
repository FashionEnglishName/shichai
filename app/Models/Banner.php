<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function setImageAttribute($path){
        $path = config('app.url') . "/uploads/images/banners/$path";
        $this->attributes['image'] = $path;
    }
}
