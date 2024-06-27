<nav id="navbar">
    <div class="container">
        <div class="w-full px-4 py-4">
            <div class="flex justify-between items-baseline">
                <a href="/" class="text-2xl font-serif font-bold">
                    Factoid.
                </a>
                <button type="button" id="hamburger-toggle" class="inline-flex items-center text-sm rounded-lg md:hidden">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden md:flex items-center gap-5 font-medium text-sm text-[#64748B]">
                    <a href="/" class="{{ request()->is('/') ? 'text-black' : '' }}">Home</a>
                    <a href="/discover"
                        class="{{ request()->is('discover/*') || request()->is('discover') ? 'text-black' : '' }}">Discover</a>
                    <a href="/recent-posts" class="{{ request()->is('recent-posts') ? 'text-black' : '' }}">Recent</a>
                    <a href="/featured" class="{{ request()->is('featured') ? 'text-black' : '' }}">Featured</a>
                    <form method="GET" action="/results"
                        class="relative flex items-center px-3   py-2 gap-2 border border-gray-300 rounded-full bg-[#F3F4F6] {{ request()->is('results') ? 'ring-1 ring-gray-600' : '' }} focus-within:ring-1 focus-within:ring-gray-600 ">
                        <i data-feather="search" class="w-4 h-4"></i>
                        <input type="search" placeholder="Search..." name="query" id="query"
                            value="{{ request('query') }}"
                            class="text-sm placeholder:font-normal focus:outline-none focus:ring-transparent text-black rounded-e-full bg-[#F3F4F6]">
                        <input type="submit" hidden>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>


<aside id="sidebar-responsive"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 sm:hidden"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
        <div class="flex items-center p-2 my-5 justify-between">
            <a href="/" class="self-center text-2xl font-bold whitespace-nowrap">
                Aiman Yusuf
            </a>
        </div>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100  group">
                    <span class="font-medium">Home</span>
                </a>
            </li>
            <li>
                <a href="/discover" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100  group">
                    <span class="font-medium">Discover</span>
                </a>
            </li>
            <li>
                <a href="/recent-posts" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100  group">
                    <span class="font-medium">Recent</span>
                </a>
            </li>
            <li>
                <a href="/featured" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100  group">
                    <span class="font-medium">Featured</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
