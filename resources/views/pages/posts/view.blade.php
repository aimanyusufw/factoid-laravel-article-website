@extends('Layouts.main')
@section('content')
    <section class="py-4 min-h-screen">
        <div class="container">
            <article class="w-full">
                <img src="{{ $post->banner_url }}" alt="{{ $post->title }}" class="rounded-md m-4">
                <div class="flex items-center justify-between p-4">
                    <h1 class="font-bold text-4xl font-inria-serif">{{ $post->title }}</h1>
                    <button>
                        <i data-feather="send"></i>
                    </button>
                </div>
                <div class="flex gap-4 items-center p-4 font-inter font-medium text-sm text-secondary ">
                    <img src="{{ $post->author->profile_picture }}" alt="{{ $post->author->name }}"
                        class="rounded-full h-10 w-10">
                    <span class="font-inter font-medium text-sm text-secondary">{{ $post->author->name }}
                        ·
                        {{ $post->published_at->diffForHumans() }}</span> ·
                    <a href="/category/{{ $post->category->slug }}"
                        class="font-bold text-black hover:underline">{{ $post->category->name }}</a>·
                    {{ $post->readTime() }}
                </div>
                <div class="flex w-full justify-between">
                    <div class="prose lg:prose-lg max-w-full p-4 md:max-w-[75%] ">
                        {!! $post->content !!}
                    </div>
                    @if ($popularPosts && $popularPosts->count() >= 5)
                        <div class="w-1/4 hidden md:block p-4 ">
                            @foreach ($popularPosts as $index => $post)
                                <div class="flex items-center mb-4">
                                    <a href="/post/{{ $post->slug }}"
                                        class="font-bold text-6xl font-inria-serif">{{ $index + 1 }}</a>
                                    <div class="ml-2">
                                        <a href="/post/{{ $post->slug }}"
                                            class="line-clamp-1 font-bold text-2xl font-inria-serif">{{ $post->title }}
                                        </a>
                                        <span class="font-inter text-sm  text-secondary"><a
                                                href="/category/{{ $post->category->slug }}"
                                                class="hover:underline text-black">{{ $post->category->name }}</a>
                                            · {{ $post->readTime() }}</span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </article>
            <div class="w-full px-4 mt-12 mb-8 flex justify-between items-baseline">
                <h1 class="font-bold text-2xl font-inria-serif">Posts You Might Like</h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mb-12">
                @foreach ($post->relatedArticles() as $post)
                    <div class="p-4">
                        <a href="/post/{{ $post->slug }}">
                            <img src="{{ $post->banner_url }}" alt="{{ $post->title }}"
                                class="rounded-md shadow-md mb-4">
                        </a>
                        <h5 class="text-sm text-secondary mb-4">
                            <a href="/category/{{ $post->category->slug }}"
                                class="font-bold text-black hover:underline">{{ $post->category->name }}</a> ·
                            {{ $post->readTime() }}
                        </h5>
                        <a href="/post/{{ $post->slug }}">
                            <h1 class="font-inria-serif text-2xl capitalize font-bold leading-snug line-clamp-3 mb-4">
                                {{ $post->title }}
                            </h1>
                        </a>
                        <div class="flex gap-4 items-center mb-4">
                            <img src="{{ $post->author->profile_picture }}" alt="{{ $post->author->name }}"
                                class="rounded-full h-10 w-10">
                            <span class="font-inter font-medium text-sm text-secondary">{{ $post->author->name }}
                                ·
                                {{ $post->published_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection