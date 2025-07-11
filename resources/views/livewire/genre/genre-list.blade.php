<div>
    <livewire:navbar />
    <div class="container mx-auto mt-7 px-5 lg:px-10 xl:px-14 xl:mt-12">
        <div class="flex gap-5 items-center">
            <div class="w-full border border-[#FFA500]"></div>
            <div class="whitespace-nowrap">
                <h1 class="text-xl font-bold lg:text-2xl xl:text-3xl">Genres</h1>
            </div>
            <div class="w-full border border-[#FFA500]"></div>
        </div>

        <div class="mt-5 overflow-x-auto custom-scroll snap-x snap-mandatory h-10">
            <div class="flex gap-5 w-max flex-nowrap font-semibold text-lg">
                <button wire:click="updateFetchGenres('movie')"
                    class="{{ $activeTab === 'movie' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                    Movies
                </button>
                <button wire:click="updateFetchGenres('tv')"
                    class="{{ $activeTab === 'tv' ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500]' }} cursor-pointer whitespace-nowrap">
                    Tv
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 font-semibold gap-3 mt-5 pb-10">
            @forelse ($genres as $item)
                <a href="{{ url('/genres/' . $activeTab . '/' . $item['name']) }}" wire:navigate
                    class="px-3 py-2 bg-white/30 rounded md:text-lg lg:text-xl lg:px-4 lg:py-3 xl:text-2xl xl:px-5 xl:py-4">{{ $item['name'] }}</a>
            @empty
                <div class="text-center">
                    <p class="text-white font-semibold">No genres found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
