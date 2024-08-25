<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'receiver_id'); // 'receiver_id' is the foreign key in the messages table
    }

}
