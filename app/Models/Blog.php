<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';

    protected $fillable = [
        'user_id',
        'image',
        'text',
    ];
    protected $appends = ['like_check'];


    public function getLikeCheckAttribute(){
        $like = LikeBlog::where('blog_id', $this->id)->where('user_id', auth()->user()->id)->first();
        if($like && $like != ''){
            return 1;
        }else{
            return 0;
        }
    }


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comments', 'blog_id');
    }
    public function likes(){
        return $this->hasMany('App\Models\LikeBlog', 'blog_id');
    }
}
