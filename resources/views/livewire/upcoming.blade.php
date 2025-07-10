<div x-data="{ scrollEl: null }" x-init="scrollEl = $refs.scrollContainer">
    <div class="flex justify-between">
        <div>
            <h1 class="text-xl font-bold md:text-2xl xl:text-4xl">Coming Soon</h1>
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

    <div x-ref="scrollContainer" class="mt-3 overflow-x-auto scroll-smooth no-scrollbar snap-x snap-mandatory md:mt-7">
        <div
            class="flex items-center gap-3 min-w-[calc(150px*2+0.75rem)] md:min-w-[calc(200px*2+0.75rem)] xl:min-w-[calc(300px*2+0.75rem)]">
            @forelse ($upcomings as $item)
                <div
                    class="w-[150px] h-[360px] flex-shrink-0 snap-start rounded overflow-hidden cursor-pointer hover:bg-white/5 transition-all md:w-[200px] md:h-[420px] xl:h-[450px]">
                    <div class="w-full h-[225px] overflow-hidden md:h-[300px]">
                        <img loading="lazy" src="{{ env('TMDB_IMAGE_BASE_URL') }}{{ $item['poster_path'] }}"
                            alt="poster {{ $item['title'] }}" class="w-full h-full object-cover object-top rounded-t">
                    </div>
                    <div class="p-2 text-white">
                        <div class="flex justify-between items-center text-sm  md:text-base">
                            <span>{{ \Carbon\Carbon::parse($item['release_date'])->format('M d, Y') }}</span>
                            <div class="flex items-center gap-1">
                                <i class="fa-solid fa-star text-yellow-500"></i>
                                {{ number_format($item['vote_average'], 1, ',', '.') }}
                            </div>
                        </div>
                        <p class="font-bold mt-2 md:text-lg xl:text-xl">{{ $item['title'] }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-white">No data found</p>
            @endforelse
        </div>
    </div>
</div>
