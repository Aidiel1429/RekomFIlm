<div>
    <livewire:navbar />
    <div class="container mx-auto mt-7 px-5 lg:px-10 xl:px-14 xl:mt-12">
        <div class="flex gap-5 items-center">
            <div class="w-full border border-[#FFA500]"></div>
            <div class="whitespace-nowrap">
                <h1 class="text-xl font-bold lg:text-2xl xl:text-3xl">Result Found: {{ $query }}</h1>
            </div>
            <div class="w-full border border-[#FFA500]"></div>
        </div>

        @if (!empty($searchs))
            <div class="mt-5 overflow-x-auto custom-scroll snap-x snap-mandatory h-10">
                <div class="flex gap-5 w-max flex-nowrap font-semibold text-lg">
                    <button wire:click="updateFetchSearch('movie')"
                        class="{{ $activeTab === 'movie' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                        Movies
                    </button>
                    <button wire:click="updateFetchSearch('tv')"
                        class="{{ $activeTab === 'tv' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                        Tv Shows
                    </button>
                    <button wire:click="updateFetchSearch('celebrity')"
                        class="{{ $activeTab === 'celebrity' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                        Celebrities
                    </button>
                </div>
            </div>
        @endif

        <div class="mt-7">
            @if (empty($searchs))
                <div class="text-center sm:text-start">
                    <h1 class="text-white text-2xl font-bold md:text-3xl">No Results Found</h1>
                    <p class="text-sm mt-2 md:text-lg lg:max-w-xl xl:max-w-3xl">
                        We couldn’t find any movies, TV shows, or celebrities matching your search query.
                        This could be due to a typo, the title being too specific or uncommon, or the content not being
                        available in our current database.
                        <br><br>
                        Try using more general keywords, double-check your spelling, or explore trending titles from our
                        homepage.
                        We’re always updating our library — so check back again soon!
                    </p>
                </div>
            @endif
            <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-3 gap-y-5">
                @foreach ($searchs as $item)
                    <a href="/{{ $activeTab }}/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['title']) }}"
                        wire:navigate>
                        <div class="w-full rounded hover:bg-white/5 transition-all">
                            <div class="w-full aspect-[2/3] overflow-hidden rounded">
                                <img loading="lazy"
                                    src="{{ $item['image'] ? env('TMDB_IMAGE_BASE_URL') . $item['image'] : 'https://placehold.co/300x450?text=No+Image' }}"
                                    alt="Poster {{ $item['title'] }}"
                                    class="w-full h-full object-cover object-top transition-all duration-300"
                                    wire:loading.class="blur-sm opacity-70"
                                    wire:target="updateFetchMovies,prevPage,nextPage" />
                            </div>
                            <div class="mt-2 p-2">
                                <h1 class="truncate text-white font-bold lg:text-xl">{{ $item['title'] }}</h1>
                                @if (!empty($item['year']))
                                    <p class="text-xs lg:text-base">
                                        {{ \Carbon\Carbon::parse($item['year'])->format('Y') }}</p>
                                @endif
                                @if (!empty($item['known_for']))
                                    <p class="text-xs lg:text-base">{{ $item['known_for'] }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if (!empty($searchs))
                <div
                    class="flex items-center justify-between gap-5 mt-5 text-white sm:mt-10 md:justify-end xl:text-lg pb-10">
                    <button wire:click="prevPage" wire:loading.attr="disabled" wire:target="prevPage"
                        class="px-4 py-1 bg-yellow-500 text-black rounded cursor-pointer disabled:opacity-50"
                        @disabled($page <= 1)>
                        <p wire:loading.remove wire:target="prevPage">Prev</p>
                        <span wire:loading wire:target="prevPage" class="loading loading-spinner loading-md"></span>
                    </button>

                    <span class="text-sm">Page {{ number_format($page) }} of {{ number_format($totalPages) }}</span>

                    <button wire:click="nextPage" wire:loading.attr="disabled" wire:target="nextPage"
                        class="px-4 py-1 bg-yellow-500 text-black rounded cursor-pointer disabled:opacity-50"
                        @disabled($page >= $totalPages)>
                        <p wire:loading.remove wire:target="nextPage">Next</p>
                        <span wire:loading wire:target="nextPage" class="loading loading-spinner loading-md"></span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
