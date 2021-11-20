<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "messages";

    protected $fillable = [
        'message',
        'sender_id',
        'receiver_id',
        'is_read',
    ];

    public function sender ()
    {
        return $this->belongsTo('App\Models\User','sender_id');
    }
    public function receiver ()
    {
        return $this->belongsTo('App\Models\User','receiver_id');
    }
}
