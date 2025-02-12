<?php

namespace App\Models;

use Database\Factories\AttachmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin IdeHelperAttachment
 */
#[UseFactory(AttachmentFactory::class)]
class Attachment extends Model
{
    use HasFactory;
    protected $fillable = ['hash_name', 'file_name', 'file_size', 'mime_type'];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }
}
