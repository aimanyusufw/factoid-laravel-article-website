<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
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

        return view("pages.posts.index", [
            "icon" => $icon,
            "title" => $title,
            "description" => $description,
            "posts" => $posts,
        ]);
    }

    public function post(Post $post)
    {
        return view("pages.posts.view", [
            "popularPosts" => Post::with("author", "category")->published()->orderBy("score", "DESC")->where('id', '!=', $post->id)->take(5)->get(),
            "post" => $post
        ]);
    }

    public function category(Category $category)
    {
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
}
