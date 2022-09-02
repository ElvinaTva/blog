<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $table = 'messages';

    protected $fillable = [
        'from_id',
        'to_id',
        'messages',
        'status',
    ];


    public function to_user(){
        return $this->belongsTo('App\Models\User', 'to_id');
    }
    public function replied(){
        return $this->hasOne('App\Models\ReplyMessage', 'message_id')->with('message');
    }
}
