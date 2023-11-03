<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;
    public function chatRoom(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class);
    }
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
