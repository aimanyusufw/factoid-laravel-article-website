<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class FrontendController extends Controller
{
    public function home()
    {
        SEOTools::setTitle("Home");
        SEOTools::setDescription("Factoid. International article website");
        SEOTools::opengraph()->setUrl(url("/"));

        $latestPost = Post::with(["author", "category"])
            ->recent()
            ->published()
            ->first();

        $excludeIds = [];

        if ($latestPost) {
            $excludeIds[] = $latestPost->id;
        }

        $popularPosts = Post::with(["author", "category"])
            ->orderBy("score", "DESC")
            ->published()
            ->take(3)
            ->get();

        $popularPostIds = $popularPosts->pluck('id')->toArray();
        $excludeIds = array_merge($excludeIds, $popularPostIds);

        $recentPosts = Post::with(["author", "category"])
            ->recent()
            ->published()
            ->whereNotIn('id', $excludeIds)
            ->take(3)
            ->get();

        $recentPostIds = $recentPosts->pluck('id')->toArray();
        $excludeIds = array_merge($excludeIds, $recentPostIds);
        $randomPosts = Post::with(["author", "category"])->published()->whereNotIn('id', $excludeIds)->inRandomOrder()->take(3)->get();

        $discovereds = Category::latest()->take(4)->get();

        return view("pages.home", [
            "latestPost" => $latestPost,
            "popularPosts" => $popularPosts,
            "recentPosts" => $recentPosts,
            "randomPosts" => $randomPosts,
            "discovereds" => $discovereds
        ]);
    }

    public function discover()
    {
        SEOTools::setTitle("Discover");
        SEOTools::setDescription("Discover page");
        SEOTools::opengraph()->setUrl(url("/discover"));

        $discovers = Category::latest()->paginate(5);

        return view("pages.discover", [
            "discovers" => $discovers
        ]);
    }

    public function recentPosts()
    {
        $posts = Post::with("author", "category")->published()->recent()->paginate(9);
        $icon = "clock";
        $title = "Fresh Off the Press";
        $description = "Stay up-to-date with our newest blog posts. From breaking news to the latest trends and insights, explore the freshest content and never miss out on what's happening. Dive into our latest updates and stay informed!";

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::jsonLd()->addImage($description);

        return view("pages.posts.index", [
            "icon" => $icon,
            "title" => $title,
            "description" => $description,
            "posts" => $posts,
        ]);
    }

    public function featured()
    {
        $posts = Post::with("author", "category")->published()->orderBy("score", "DESC")->paginate(9);
        $icon = "bookmark";
        $title = "Top Picks Just for You";
        $description = "Uncover the gems of our blog with these handpicked, standout posts. Whether it's the latest trends, in-depth insights, or captivating stories, our featured articles offer the best of the best. Dive into our top picks and enjoy the journey!";

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::jsonLd()->addImage($description);

        return view("pages.posts.index", [
            "icon" => $icon,
            "title" => $title,
            "description" => $description,
            "posts" => $posts,
        ]);
    }

    public function post(Post $post)
    {
        if (!$post->status) {
            return abort(404);
        }
        // SEO Meta Tags
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->excerpt);
        SEOMeta::setCanonical(url('/post/' . $post->slug));
        SEOMeta::addKeyword($post->tags->pluck('name')->toArray());

        // Open Graph Meta Tags
        OpenGraph::setTitle($post->title);
        OpenGraph::setDescription($post->excerpt);
        OpenGraph::setUrl(url('post/' . $post->slug));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('image', asset("storage/" . $post->banner));

        // Twitter Card Meta Tags
        TwitterCard::setTitle($post->title);
        TwitterCard::setDescription($post->excerpt);
        TwitterCard::setImage(asset("storage/" . $post->banner));

        return view("pages.posts.view", [
            "popularPosts" => Post::with("author", "category")->published()->orderBy("score", "DESC")->where('id', '!=', $post->id)->take(5)->get(),
            "post" => $post
        ]);
    }

    public function category(Category $category)
    {

        // SEO Meta Tags
        SEOMeta::setTitle($category->name);
        SEOMeta::setDescription($category->description);
        SEOMeta::setCanonical(url('dicover/' . $category->slug));

        // Open Graph Meta Tags
        OpenGraph::setTitle($category->name);
        OpenGraph::setDescription($category->description);
        OpenGraph::setUrl(url('post/' . $category->slug));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('image', asset("storage/" . $category->thumbnail));

        // Twitter Card Meta Tags
        TwitterCard::setTitle($category->name);
        TwitterCard::setDescription($category->description);
        TwitterCard::setImage(asset("storage/" . $category->thumbnail));

        return view("pages.posts.index", [
            "icon" => null,
            "title" => "Explore $category->name Insights",
            "description" => "Unlock a wealth of knowledge in $category->name. Our handpicked articles bring you the latest trends, expert advice, and engaging stories. Whether you're a novice or a seasoned enthusiast, find inspiration and deepen your understanding with our $category->name posts.",
            "posts" => Post::with("author", "category")->published()->where("blog_category_id", $category->id)->recent()->paginate(9)
        ]);
    }

    public function search()
    {
        $query = request("query");

        SEOTools::setTitle("Search Results $query");
        SEOTools::setDescription("Explore the results of your search query and find the content that matters to you. Whether you're looking for specific topics, insights, or stories, our search results bring you closer to the information you seek. Dive into your findings and discover new perspectives.");
        SEOTools::opengraph()->setUrl(url("/search?query=$query"));

        $posts = Post::with(['category', 'author'])
            ->published()
            ->recent()
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('tags', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->paginate(10);

        $posts->withPath("/results?query=$query");

        $categories = Category::where("name", "LIKE", "%{$query}%")->orWhere("description", "LIKE", "%{$query}%")->orWhereHas('posts', function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")->orWhere('content', 'LIKE', "%{$query}%");
        })->get();

        return view("pages.search", [
            "posts" => $posts,
            "categories" => $categories
        ]);
    }

    public function generateSitemap()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create("/")
                ->setLastModificationDate(Carbon::create('2024', '5', '25'))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1))
            ->add(Url::create("/discover")
                ->setLastModificationDate(Carbon::create('2024', '5', '25'))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create("/recent-posts")
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setLastModificationDate(Carbon::create('2024', '5', '25')))
            ->add(Url::create("/featured")
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setLastModificationDate(Carbon::create('2024', '5', '25')));

        Post::all()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create("blog/" . $post->slug)
                ->setLastModificationDate($post->updated_at)
                ->addImage($post->bannerUrl));
        });

        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(Url::create("blog/" . $category->slug)
                ->setLastModificationDate($category->updated_at)
                ->addImage($category->thumbnailUrl));
        });

        $sitemap->writeToFile(public_path("/sitemap.xml"));

        return redirect("/sitemap.xml");
    }
}
