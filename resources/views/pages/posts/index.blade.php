@extends('Layouts.main')
@section('content')
    <section id="Header" class="py-10">
        <div class="container min-h-screen">
            <div class="w-full flex flex-col items-center">
                <div class="w-16 h-16 bg-black rounded-full flex justify-center items-center mb-4">
                    <i data-feather="{{ $icon === null ? 'paperclip' : $icon }}" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="font-bold text-2xl md:text-3xl text-center font-serif mb-4">{{ $title }}</h1>
                <p class="text-center max-w-xl font-inter text-sm text-secondary">{{ $description }}
                </p>
            </div>
            <div class="py-8">
                @if ($posts && $posts->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($posts as $post)
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
                                    <h1
                                        class="font-inria-serif text-2xl capitalize font-bold leading-snug line-clamp-2 mb-4">
                                        {{ $post->title }}
                                    </h1>
                                </a>
                                <div class="flex gap-4 items-center mb-4">
                                    <img src="{{ $post->author->profile_picture_url }}" alt="{{ $post->author->name }}"
                                        class="rounded-full h-10 w-10">
                                    <span class="font-inter font-medium text-sm text-secondary">{{ $post->author->name }}
                                        ·
                                        {{ $post->published_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mx-auto py-10">
                        @if ($posts->hasPages())
                            <div class="flex justify-center items-center gap-2">
                                @if ($posts->currentPage() > 1)
                                    <a href="{{ $posts->previousPageUrl() }}" class="p-2 rounded-lg border-black border-2">
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
                                    <a href="{{ $posts->nextPageUrl() }}" class="p-2 rounded-lg border-2  border-black">
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
    </section>
@endsection
