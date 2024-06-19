<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        "title", "slug", "excerpt", "banner", "content", "published_at", "blog_category_id", "blog_author_id", "status"
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    protected $appends = [
        "banner_url"
    ];

    public function bannerUrl(): Attribute
    {
        return Attribute::get(fn () => $this->banner ? asset(Storage::url($this->banner))  : "");
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull("published_at");
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, "blog_author_id");
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "blog_category_id");
    }
}
