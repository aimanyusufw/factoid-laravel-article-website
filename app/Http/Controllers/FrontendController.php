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
}
