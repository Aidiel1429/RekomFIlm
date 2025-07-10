<div class="mb-10">
    <livewire:navbar />
    <div class="container mx-auto mt-7 px-5 lg:px-10 xl:px-14 xl:mt-12">
        <div class="flex gap-5 items-center">
            <div class="w-full border border-[#FFA500]"></div>
            <div class="whitespace-nowrap">
                <h1 class="text-xl font-bold lg:text-2xl xl:text-3xl">Movies</h1>
            </div>
            <div class="w-full border border-[#FFA500]"></div>
        </div>

        <div class="mt-5 overflow-x-auto custom-scroll snap-x snap-mandatory h-10">
            <div class="flex gap-5 w-max flex-nowrap font-semibold text-lg">
                <button wire:click="updateFetchMovies('all')"
                    class="{{ $activeTab === 'all' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                    All
                </button>
                <button wire:click="updateFetchMovies('now_playing')"
                    class="{{ $activeTab === 'now_playing' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                    Now Playing
                </button>
                <button wire:click="updateFetchMovies('upcoming')"
                    class="{{ $activeTab === 'upcoming' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                    Coming Soon
                </button>
                <button wire:click="updateFetchMovies('top_rated')"
                    class="{{ $activeTab === 'top_rated' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                    Top Rated
                </button>
                <button wire:click="updateFetchMovies('popular')"
                    class="{{ $activeTab === 'popular' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                    Popular
                </button>
            </div>
        </div>

        <div class="mt-7">
            <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-3 gap-y-5">
                @forelse ($movies as $item)
                    <div class="w-full">
                        <div class="w-full aspect-[2/3] overflow-hidden rounded">
                            <img loading="lazy" src="{{ env('TMDB_IMAGE_BASE_URL') }}{{ $item['poster_path'] }}"
                                alt="Poster {{ $item['title'] }}"
                                class="w-full h-full object-cover object-top transition-all duration-300"
                                wire:loading.class="blur-sm opacity-70"
                                wire:target="updateFetchMovies,prevPage,nextPage" />
                        </div>
                        <div class="mt-2">
                            <h1 class="truncate text-white font-bold lg:text-xl">{{ $item['title'] }}</h1>
                            <p class="text-xs lg:text-base">
                                {{ \Carbon\Carbon::parse($item['release_date'])->format('Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center text-white">No movies found</div>
                @endforelse
            </div>

            <div class="flex items-center justify-between gap-5 mt-5 text-white sm:mt-10 md:justify-end xl:text-lg">
                <button wire:click="prevPage" wire:loading.attr="disabled" wire:target="prevPage"
                    class="px-4 py-1 bg-yellow-500 text-black rounded cursor-pointer disabled:opacity-50"
                    @disabled($page <= 1)>
                    <p wire:loading.remove wire:target="prevPage">Prev</p>
                    <span wire:loading wire:target="prevPage" class="loading loading-spinner loading-md"></span>
                </button>

                <span class="text-sm">Page {{ $page }} of {{ $totalPages }}</span>

                <button wire:click="nextPage" wire:loading.attr="disabled" wire:target="nextPage"
                    class="px-4 py-1 bg-yellow-500 text-black rounded cursor-pointer disabled:opacity-50"
                    @disabled($page >= $totalPages)>
                    <p wire:loading.remove wire:target="nextPage">Next</p>
                    <span wire:loading wire:target="nextPage" class="loading loading-spinner loading-md"></span>
                </button>
            </div>
        </div>

    </div>
</div>
