@extends('Layouts.main')
@section('content')
    <section class="py-10" id="Search Result">
        <div class="container min-h-screen">
            <div class="w-full flex flex-col items-center p-4">
                <div class="w-16 h-16 bg-black rounded-full flex justify-center items-center mb-4">
                    <i data-feather="gift" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="font-bold text-2xl md:text-3xl text-center font-serif mb-4">Search Results</h1>
                <p class="text-center max-w-xl font-inter text-sm text-secondary">
                    Explore the results of your search query and find the content that matters to you. Whether you're
                    looking for specific topics, insights, or stories, our search results bring you closer to the
                    information you seek. Dive into your findings and discover new perspectives.
                </p>
            </div>
            <div class="w-full flex justify-between flex-wrap-reverse py-8">
                <div class="w-full lg:w-3/4 px-4">
                    <h1 class="font-bold font-inria-serif text-xl mb-4">Posts</h1>
                    @if ($posts && $posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-5">
                                <a href="/post/{{ $post->slug }}">
                                    <img src="{{ $post->banner_url }}" alt="{{ $post->title }}"
                                        class="rounded-md shadow-md mb-4">
                                </a>
                                <div>
                                    <h5 class="text-sm text-secondary mb-4">
                                        <a href="/discover/{{ $post->category->slug }}"
                                            class="font-bold text-black hover:underline">{{ $post->category->name }}</a>
                                        ·
                                        {{ $post->readTime() }}
                                    </h5>
                                    <a href="/post/{{ $post->slug }}">
                                        <h1
                                            class="font-inria-serif text-2xl capitalize font-bold leading-snug line-clamp-3 mb-4">
                                            {{ $post->title }}
                                        </h1>
                                    </a>
                                    <p class="text-sm text-secondary max-w-xs line-clamp-2 mb-4">{{ $post->excerpt }}</p>
                                    <div class="flex gap-4 items-center">
                                        <img src="{{ $post->author->profile_picture_url }}" alt="{{ $post->author->name }}"
                                            class="rounded-full h-10 w-10">
                                        <span
                                            class="font-inter font-medium text-sm text-secondary">{{ $post->author->name }}
                                            ·
                                            {{ $post->published_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mx-auto py-10">
                            @if ($posts->hasPages())
                                <div class="flex justify-center items-center gap-2">
                                    @if ($posts->currentPage() > 1)
                                        <a href="{{ $posts->previousPageUrl() }}"
                                            class="p-2 rounded-lg border-black border-2">
                                            <i class="h-5 w-5 text-black" data-feather="chevron-left"></i>
                                        </a>
                                    @else
                                        <button disabled="disabled"
                                            class=" p-2 rounded-lg border hover:cursor-not-allowed border-secondary">
                                            <i class="h-5 w-5 text-secondary" data-feather="chevron-left"></i>
                                        </button>
                                    @endif

                                    <span class="px-3 py-1 rounded-lg border-2 font-medium font-inter text-xl border-black">
                                        {{ $posts->currentPage() }}
                                    </span>

                                    @if ($posts->currentPage() < $posts->lastPage())
                                        <a href="{{ $posts->nextPageUrl() }}"
                                            class="p-2 rounded-lg border-2  border-black">
                                            <i class="h-5 w-5 text-black" data-feather="chevron-right"></i>
                                        </a>
                                    @else
                                        <button disabled="disabled"
                                            class=" p-2 rounded-lg border hover:cursor-not-allowed border-secondary">
                                            <i class="h-5 w-5 text-secondary" data-feather="chevron-right"></i>
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="w-full lg:w-1/4 px-4">
                    <h1 class="font-bold font-inria-serif text-xl mb-4">Categories</h1>
                    @if ($categories && $categories->count() > 0)
                        @foreach ($categories as $category)
                            <a href="/discover/{{ $category->slug }}">
                                <div class="w-full mb-4 overflow-hidden bg-center bg-cover rounded-xl"
                                    style="background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ $category->thumbnail_url }});">
                                    <h1
                                        class="z-10 font-inria-serif font-bold text-2xl text-white text-center leading-normal py-4">
                                        {{ $category->name }}
                                    </h1>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            @if ($posts->count() < 1 && $categories->count() < 1)
                <div class="py-32 w-full">
                    <h1 class="font-bold font-inria-serif text-2xl text-center">404</h1>
                    <h1 class="font-bold font-inria-serif text-2xl text-center">Result Not Found</h1>
                </div>
            @endif
        </div>
    </section>
@endsection
