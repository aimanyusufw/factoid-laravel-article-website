<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasTags;
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        "title", "slug", "excerpt", "banner", "content", "published_at", "blog_category_id", "blog_author_id", "status", "score"
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    protected $appends = [
        "banner_url"
    ];

    public function relatedArticles()
    {
        $relatedArticles = [];
        if (Post::all()->count() < 4) {
            return $relatedArticles;
        }

        $relatedArticles = Post::with("author", "category")
            ->where('id', '!=', $this->id)
            ->withAnyTags($this->tags)
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        while ($relatedArticles->count() < 3) {
            $randomPost = Post::with("author", "category")
                ->published()
                ->inRandomOrder()
                ->where('id', '!=', $this->id)
                ->take(3 - $relatedArticles->count())
                ->first();

            if ($randomPost && !$relatedArticles->contains('id', $randomPost->id)) {
                $relatedArticles->push($randomPost);
            }
        }

        return $relatedArticles;
    }

    public function scopeRecent($query)
    {
        return $query->orderBy("published_at", "DESC");
    }

    public function readTime()
    {
        $readingTime = ceil(str_word_count(strip_tags($this->content)) / 250);

        return $readingTime . " min read";
    }

    public function bannerUrl(): Attribute
    {
        return Attribute::get(fn () => $this->banner ? asset(Storage::url($this->banner))  : "");
    }

    public function scopePublished($query)
    {
        return $query->where("status", '=', 1);
    }

    public function getRouteKeyName()
    {
        return "slug";
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
