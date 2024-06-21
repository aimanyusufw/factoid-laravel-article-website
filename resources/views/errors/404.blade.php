@extends('Layouts.main')
@section('content')
    <section class="min-h-screen">
        <div class="container">
            <div class="h-screen flex justify-center items-center">
                <div class="p-4">
                    <h3 class="font-bold font-inter text-2xl italic">Oops! Looks like you’re lost...</h3>
                    <h1 class="font-bold mb-4 font-inter text-9xl italic">404</h1>
                    <p class="max-w-md text-sm mb-4">Like a cat stuck in a too-small box, the page you’re looking for can’t
                        be
                        found.
                        Don’t worry, it’s
                        not your fault! Maybe the page is on vacation, or we just misplaced it.</p>
                    <p class="max-w-md text-sm mb-3">Try :</p>
                    <ul class="list-disc ms-5 mb-3">
                        <li>
                            <p class="text-sm">Double-checking your URL</p>
                        </li>
                        <li>
                            <p class="text-sm">Going back to the <a href="/" class="underline">homepage</a></p>
                        </li>
                        <li>
                            <p class="text-sm">Searching for something else</p>
                        </li>
                    </ul>
                    <p class="max-w-md text-sm mb-3">Or, take a deep breath, smile, and remember that we all get lost on the
                        internet sometimes.
                    </p>
                    <p class="max-w-md text-sm mb-3">Keep exploring, internet adventurer!
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
