@extends('Layouts.main')
@section('content')
    <section id="Header" class="py-10">
        <div class="container">
            <div class="w-full flex flex-col items-center">
                <div class="w-16 h-16 bg-black rounded-full flex justify-center items-center mb-4">
                    <i data-feather="paperclip" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="font-bold text-2xl md:text-3xl text-center font-serif mb-4">Discover All Categories</h1>
                <p class="text-center max-w-xl font-inter text-sm text-secondary">Explore our diverse range of blog
                    categories and find the
                    content that
                    interests you
                    most. From
                    insightful articles to engaging stories, there's something for everyone. Dive in and start discovering!
                </p>
            </div>
        </div>
    </section>
    <div class="pt-8 pb-24" id="Discover">
        <div class="container">
            @if ($discovers && $discovers->count() > 1)
                <div class="px-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-10">
                    @foreach ($discovers as $category)
                        <a href="/category/{{ $category->slug }}">
                            <div class="w-full h-[400px] overflow-hidden bg-center bg-cover rounded-xl relative bg-black"
                                style="background-image: url({{ $category->thumbnail }});">
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
@endsection
