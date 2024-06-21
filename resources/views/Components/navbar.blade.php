<nav class="container absolute top-0 left-0 right-0">
    <div class="w-full px-4 py-5">
        <div class="flex justify-between items-baseline">
            <a href="/" class="text-2xl font-serif font-bold">
                Factoid.
            </a>
            <div class="flex items-center gap-5 font-medium text-sm text-[#64748B]">
                <a href="/" class="{{ request()->url('/') ? 'text-black' : '' }}">Home</a>
                <a href="/discovered">Discover</a>
                <a href="/featured">Featured</a>
                <div
                    class="relative flex items-center px-3   py-2 gap-2 border border-gray-300 rounded-full bg-[#F3F4F6] focus-within:ring-1 focus-within:ring-gray-600">
                    <i data-feather="search" class="w-4 h-4"></i>
                    <input type="text" placeholder="Search..."
                        class="text-sm placeholder:font-normal focus:outline-none focus:ring-transparent text-black rounded-e-full bg-[#F3F4F6]">
                </div>
            </div>

        </div>
    </div>
</nav>
