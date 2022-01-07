<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @method static find($postId)
 * @method static hydrate(array $all)
 */
class Post extends Model
{
    use HasFactory;

    /**
     * Checks if post has an attached image.
     */
    public function hasImageAttached(): bool
    {
        return $this->image != '' && Storage::exists('public/'.$this->image);
    }


    /**
     * Define OneToMany relationship with comments.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
