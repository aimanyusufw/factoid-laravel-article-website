<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Author extends Model
{
    use HasFactory;

    protected $table = 'blog_authors';

    protected $fillable = [
        "name",
        "position",
        "email",
        "profile_picture",
        "bio",
        "github_handle",
        "twitter_handle",
        "instagram_handle"
    ];

    protected $appends = [
        "profile_picture_url"
    ];

    public function profilePictureUrl(): Attribute
    {
        return Attribute::get(fn () => $this->profile_picture ? asset(Storage::url($this->profile_picture)) : "");
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, "blog_author_id");
    }
}
