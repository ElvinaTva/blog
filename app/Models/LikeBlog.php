<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeBlog extends Model
{
    use HasFactory;
    protected $table = 'like_blogs';

    protected $fillable = [
        'user_id',
        'blog_id',
    ];


    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
