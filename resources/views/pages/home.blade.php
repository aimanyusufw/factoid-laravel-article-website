@extends('Layouts.main')
@section('content')
    <section id="Recent Post" class="py-4">
        <div class="container">
            @if ($latestPost && $latestPost !== null)
                <div class="w-full flex flex-wrap justify-between items-center">
                    <div class="w-full md:w-1/2 px-4">
                        <a href="/post/{{ $latestPost->slug }}">
                            <img src="{{ $latestPost->banner_url }}" alt="" class="rounded-lg shadow-lg">
                        </a>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <div class="flex gap-4 items-center mb-4">
                            <img src="{{ $latestPost->author->profile_picture_url }}" alt="{{ $latestPost->author->name }}"
                                class="rounded-full h-10 w-10">
                            <span class="font-inter font-medium text-sm text-secondary">{{ $latestPost->author->name }} ·
                                {{ $latestPost->published_at->diffForHumans() }}</span>
                        </div>
                        <a href="/post/{{ $latestPost->slug }}">
                            <h1 class="font-inria-serif text-4xl capitalize font-bold leading-snug line-clamp-3 mb-4">
                                {{ $latestPost->title }}
                            </h1>
                        </a>
                        <p class="font-inter text-sm text-secondary max-w-sm line-clamp-2 mb-4">{{ $latestPost->excerpt }}
                        </p>
                        <h5 class="text-sm text-secondary">
                            <a href="/category/{{ $latestPost->category->slug }}"
                                class="font-bold text-black hover:underline">{{ $latestPost->category->name }}</a> ·
                            {{ $latestPost->readTime() }}
                        </h5>
                    </div>
                </div>
            @else
                <div class="w-full min-h-screen flex justify-center items-center">
                    <h1 class="font-bold text-3xl font-serif italic text-center">We don't ready yet</h1>
                </div>
            @endif
        </div>
    </section>
    <div class="py-8" id="Popular Post">
        <div class="container">
            @if ($popularPosts && $popularPosts->count() == 3)
                <div class="w-full px-4 mb-12 flex justify-between items-baseline">
                    <h1 class="font-bold text-2xl font-inria-serif">Popular News</h1>
                    <a href="/featured" class="text-xs hover:underline font-medium">
                        Show All
                        <i data-feather="arrow-up-right" class="inline ms-2 h-4 w-4"></i>
                    </a>
                </div>
                <div class="w-full flex flex-wrap justify-between items-start">
                    <div class="w-full md:w-[65%] px-4">
                        <a href="/post/{{ $popularPosts[0]->slug }}">
                            <img src="{{ $popularPosts[0]->banner_url }}" alt="" class="rounded-lg shadow-lg mb-5">
                        </a>
                        <div class="flex gap-4 items-center mb-4">
                            <img src="{{ $popularPosts[0]->author->profile_picture_url }}"
                                alt="{{ $popularPosts[0]->author->name }}" class="rounded-full h-10 w-10">
                            <span
                                class="font-inter font-medium text-sm text-secondary">{{ $popularPosts[0]->author->name }}
                                ·
                                {{ $popularPosts[0]->published_at->diffForHumans() }}</span>
                        </div>
                        <a href="/post/{{ $popularPosts[0]->slug }}">
                            <h1 class="font-inria-serif text-4xl capitalize font-bold leading-snug line-clamp-3 mb-4">
                                {{ $popularPosts[0]->title }}
                            </h1>
                        </a>
                        <p class="font-inter text-sm text-secondary max-w-sm line-clamp-5 mb-4">
                            {{ $popularPosts[0]->excerpt }}
                        </p>
                        <h5 class="text-sm text-secondary">
                            <a href="/category/{{ $popularPosts[0]->category->name }}"
                                class="font-bold text-black hover:underline">{{ $popularPosts[0]->category->name }}</a> ·
                            {{ $popularPosts[0]->readTime() }}
                        </h5>
                    </div>
                    <div class="w-full md:w-[35%] px-4 flex flex-col justify-between gap-6">
                        @foreach ($popularPosts->skip(1) as $post)
                            <div class="flex flex-col gap-4">
                                <a href="/post/{{ $post->slug }}">
                                    <img src="{{ $post->banner_url }}" alt="{{ $post->title }}"
                                        class="rounded-md shadow-lg">
                                </a>
                                <a href="/post/{{ $post->slug }}">
                                    <h1 class="font-bold font-inria-serif text-xl">{{ $post->title }}</h1>
                                </a>
                                <h5 class="text-sm text-secondary">
                                    <a href="/category/{{ $post->category->name }}"
                                        class="font-bold text-black hover:underline">{{ $post->category->name }}</a> ·
                                    {{ $post->readTime() }}
                                </h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="py-8" id="Recent Post">
        <div class="container">
            @if ($recentPosts && $recentPosts->count() == 3)
                <div class="w-full px-4 mb-12 flex justify-between items-baseline">
                    <h1 class="font-bold text-2xl font-inria-serif">Recent News</h1>
                    <a href="/recent-posts" class="text-xs hover:underline font-medium">
                        Show All
                        <i data-feather="arrow-up-right" class="inline ms-2 h-4 w-4"></i>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($recentPosts as $post)
                        <div class="px-4">
                            <a href="/post/{{ $post->slug }}">
                                <img src="{{ $post->banner_url }}" alt="{{ $post->title }}"
                                    class="rounded-md shadow-lg mb-4">
                            </a>
                            <div class="flex gap-4 items-center mb-4">
                                <img src="{{ $popularPosts[0]->author->profile_picture_url }}"
                                    alt="{{ $popularPosts[0]->author->name }}" class="rounded-full h-10 w-10">
                                <span
                                    class="font-inter font-medium text-sm text-secondary">{{ $popularPosts[0]->author->name }}
                                    ·
                                    {{ $popularPosts[0]->published_at->diffForHumans() }}</span>
                            </div>
                            <h5 class="text-sm text-secondary mb-4">
                                <a href="/category/{{ $post->category->name }}"
                                    class="font-bold text-black hover:underline">{{ $post->category->name }}</a> ·
                                {{ $post->readTime() }}
                            </h5>
                            <a href="/post/{{ $post->slug }}">
                                <h1 class="font-inria-serif text-2xl capitalize font-bold leading-snug line-clamp-3 mb-4">
                                    {{ $post->title }}
                                </h1>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="py-8" id="Discover">
        <div class="container">
            @if ($discovereds && $discovereds->count() == 4)
                <div class="w-full px-4 mb-12 flex justify-between items-baseline">
                    <h1 class="font-bold text-2xl font-inria-serif">Discovered</h1>
                    <a href="/discover" class="text-xs hover:underline font-medium">
                        Show All
                        <i data-feather="arrow-up-right" class="inline ms-2 h-4 w-4"></i>
                    </a>
                </div>
                <div class="px-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-10">
                    @foreach ($discovereds as $category)
                        <a href="/discover/{{ $category->slug }}">
                            <div class="w-full h-[400px] overflow-hidden bg-center bg-cover rounded-xl relative bg-black"
                                style="background-image: url({{ $category->thumbnail_url }});">
                                <div
                                    class="absolute bg-black bg-opacity-50 top-0 left-0 right-0 bottom-0 flex justify-center items-center">
                                    <h1
                                        class="z-10 font-inria-serif font-bold text-2xl text-white text-center leading-normal">
                                        {{ $category->name }}</h1>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="py-8" id="Random Post">
        <div class="container">
            @if ($randomPosts && $randomPosts->count() == 3)
                <div class="w-full px-4 mb-12 flex justify-between items-baseline">
                    <h1 class="font-bold text-2xl font-inria-serif">Posts You Might Like</h1>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($randomPosts as $post)
                        <div class="px-4">
                            <a href="/post/{{ $post->slug }}">
                                <img src="{{ $post->banner_url }}" alt="{{ $post->title }}"
                                    class="rounded-md shadow-lg mb-4">
                            </a>
                            <div class="flex gap-4 items-center mb-4">
                                <img src="{{ $post->author->profile_picture_url }}" alt="{{ $post->author->name }}"
                                    class="rounded-full h-10 w-10">
                                <span class="font-inter font-medium text-sm text-secondary">{{ $post->author->name }}
                                    ·
                                    {{ $post->published_at->diffForHumans() }}</span>
                            </div>
                            <h5 class="text-sm text-secondary mb-4">
                                <a href="/category/{{ $post->category->name }}"
                                    class="font-bold text-black hover:underline">{{ $post->category->name }}</a> ·
                                {{ $post->readTime() }}
                            </h5>
                            <a href="/post/{{ $post->slug }}">
                                <h1 class="font-inria-serif text-2xl capitalize font-bold leading-snug line-clamp-3 mb-4">
                                    {{ $post->title }}
                                </h1>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <section class="py-40" id="Suscribe">
        <div class="container">
            <div class="w-full flex justify-center items-center">
                <div class="p-4">
                    <h5 class="font-medium font-inter mb-5 md:text-center">Want to be left behind with our updates?</h5>
                    <h1 class="md:text-center capitalize font-bold font-inria-serif text-2xl md:text-4xl mb-8">stay up to
                        date
                        with our
                        newsletter</h1>
                    <div class="flex gap-2">
                        <div
                            class="w-full relative flex items-center px-4 py-3 gap-2 border border-gray-300 rounded-full bg-[#F3F4F6] focus-within:ring-1 focus-within:ring-gray-600">
                            <i data-feather="mail" class="w-5 h-5"></i>
                            <input type="text" placeholder="Your Email Here"
                                class="text-sm w-full placeholder:font-normal placeholder:font-inria-serif focus:outline-none focus:ring-transparent text-black rounded-e-full bg-[#F3F4F6]">
                        </div>
                        <button type="submit"
                            class="px-6 py-3 bg-black text-white font-inria-serif rounded-full text-s,">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
