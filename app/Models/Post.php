<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saving(
            fn(self $post) => $post->fill([
                "html" => str($post->body)->markdown(),
            ])
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cabinetShowRoute(): string
    {
        return route("cabinet.posts.show", $this);
    }
}
