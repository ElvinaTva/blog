<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyMessage extends Model
{
    use HasFactory;
    protected $table = 'reply_messages';

    protected $fillable = [
        'replied_id',
        'message_id'
    ];


    public function message(){
        return $this->belongsTo('App\Models\Messages', 'replied_id');
    }
}
