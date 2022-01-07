<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 */
class Comment extends Model
{
    use HasFactory;

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
