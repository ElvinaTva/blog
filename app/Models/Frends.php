<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frends extends Model
{
    use HasFactory;

    protected $table = 'frends';

    protected $fillable = [
        'user_id',
        'friend_id',
    ];


    public function friend(){
        return $this->belongsTo('App\Models\User', 'friend_id');
    }
}
