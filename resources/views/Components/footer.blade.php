<footer class="py-14 bg-black">
    <div class="container">
        <div class="w-full px-4">
            <div class="flex flex-col md:flex-row justify-between items-baseline pb-4 border-b border-slate-500">
                <a href="/" class="text-2xl font-serif text-white font-bold">Factoid.</a>
                <div class="flex flex-col md:flex-row mt-5 md:mt-0 gap-4 text-sm text-[#C6C6C6] font-inter">
                    @foreach ($socialMedia as $data)
                        <a href="https://{{ $data->profile_url }}" target="blank">{{ $data->platform }}</a>
                    @endforeach
                </div>
            </div>
            <p class="md:text-center text-slate-400 text-xs mt-4 font-inter">©2024 <a href="/"
                    class="text-white hover:underline">Factoid</a>. All Rights
                Reserved.</p>
        </div>
    </div>
</footer>
