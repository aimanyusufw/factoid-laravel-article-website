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
            ->orderBy("published_at", "DESC")
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
            ->orderBy("published_at", "DESC")
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

        if ($discovers->count() < 1) {
            return redirect("/");
        }

        return view("pages.discover", [
            "discovers" => $discovers
        ]);
    }

    public function recentPosts()
    {
        $posts = Post::with("author", "category")->published()->latest()->paginate(9);
        $icon = "clock";
        $title = "Fresh Off the Press";
        $description = "Stay up-to-date with our newest blog posts. From breaking news to the latest trends and insights, explore the freshest content and never miss out on what's happening. Dive into our latest updates and stay informed!";

        if ($posts->count() < 1) {
            return redirect("/");
        }

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

        if ($posts->count() < 1) {
            return redirect("/");
        }

        return view("pages.posts.index", [
            "icon" => $icon,
            "title" => $title,
            "description" => $description,
            "posts" => $posts,
        ]);
    }
}
