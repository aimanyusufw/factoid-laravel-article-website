@extends('Layouts.main')
@section('content')
    <section id="Header" class="py-10">
        <div class="container">
            <div class="w-full flex flex-col items-center">
                <div class="w-16 h-16 bg-black rounded-full flex justify-center items-center mb-4">
                    <i data-feather="{{ $icon }}" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="font-bold text-2xl md:text-3xl text-center font-serif mb-4">{{ $title }}</h1>
                <p class="text-center max-w-xl font-inter text-sm text-secondary">{{ $description }}
                </p>
            </div>
        </div>
    </section>
    <div class="pt-8 pb-24" id="Discover">
        <div class="container">
            @if ($posts && $posts->count() > 1)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                    @foreach ($posts as $post)
                        <div class="p-4">
                            <img src="{{ $post->banner }}" alt="{{ $post->title }}" class="rounded-md shadow-md mb-4">
                            <h5 class="text-sm text-secondary mb-4">
                                <span class="font-bold text-black">{{ $post->category->name }}</span> ·
                                {{ $post->readTime() }}
                            </h5>
                            <h1 class="font-inria-serif text-2xl capitalize font-bold leading-snug line-clamp-3 mb-4">
                                {{ $post->title }}
                            </h1>
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
            @endif
        </div>
    </div>
@endsection
