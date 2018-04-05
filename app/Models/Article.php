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
}
