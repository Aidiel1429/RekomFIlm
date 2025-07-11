<div x-data="{ scrollEl: null }" x-init="scrollEl = $refs.scrollContainer">
    <div class="flex justify-between">
        <div>
            <h1 class="text-xl font-bold md:text-2xl xl:text-4xl">Top Rated</h1>
            <div class="border border-[#FFA500] w-8 md:w-10 xl:w-14 xl:border-2 xl:mt-1"></div>
        </div>
        <div class="hidden lg:flex items-center gap-2">
            <button @click="scrollEl.scrollBy({ left: -300, behavior: 'smooth' })"
                class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button @click="scrollEl.scrollBy({ left: 300, behavior: 'smooth' })"
                class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <div class="relative mt-3 md:mt-7">
        <div x-ref="scrollContainer"
            class="overflow-x-auto snap-x snap-mandatory flex items-center gap-3 scroll-smooth no-scrollbar">
            @forelse ($topRateds as $item)
                <a href="/movie/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['title']) }}" wire:navigate>
                    <div
                        class="w-[150px] h-[360px] flex-shrink-0 snap-start rounded overflow-hidden cursor-pointer hover:bg-white/5 transition-all md:w-[200px] md:h-[420px] xl:h-[450px]">
                        <div class="w-full h-[225px] overflow-hidden md:h-[300px]">
                            <img loading="lazy"
                                src="{{ $item['poster_path'] ? env('TMDB_IMAGE_BASE_URL') . $item['poster_path'] : 'https://placehold.co/130x200?text=No+Poster' }}"
                                alt="Poster {{ $item['title'] }}"
                                class="w-full h-full object-cover object-top rounded-t">
                        </div>
                        <div class="p-2 text-white">
                            <div class="flex justify-between items-center text-sm md:text-base">
                                <span>{{ \Carbon\Carbon::parse($item['release_date'])->format('M d, Y') }}</span>
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-star text-yellow-500"></i>
                                    {{ number_format($item['vote_average'], 1, ',', '.') }}
                                </div>
                            </div>
                            <p class="font-bold mt-2 md:text-lg xl:text-xl">{{ $item['title'] }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center text-white">No data found</p>
            @endforelse
        </div>
    </div>
</div>
