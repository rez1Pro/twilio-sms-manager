<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMessage extends Model
{
    /** @use HasFactory<\Database\Factories\SendMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'sender',
        'receiver',
        'message',
        'status',
        'delivered_at',
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
    ];
}
