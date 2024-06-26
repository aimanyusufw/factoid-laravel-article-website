<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\HasTags;

class Category extends Model
{
    use HasTags;
    use HasFactory;

    protected $table = 'blog_categories';

    protected $fillable = [
        "name", "slug", "thumbnail", "description",
    ];

    protected $appends = ["thumbnail_url"];

    public function thumbnailUrl(): Attribute
    {
        return Attribute::get(fn () => $this->thumbnail ? asset(Storage::url($this->thumbnail)) : "");
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, "blog_category_id");
    }
}
