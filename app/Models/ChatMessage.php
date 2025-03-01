<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\ChatMessageFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;

/**
 * @mixin IdeHelperChatMessage
 */
#[UseFactory(ChatMessageFactory::class)]
class ChatMessage extends Model
{
    /** @use HasFactory<ChatMessageFactory> */
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
        'is_read',
    ];

    public function casts(): array
    {
        return [
            'chat_id' => 'int',
            'user_id' => 'int',
            'message' => 'string',
            'is_read' => 'boolean',
        ];
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
