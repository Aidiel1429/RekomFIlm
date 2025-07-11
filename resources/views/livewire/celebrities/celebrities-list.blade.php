<div>
    <livewire:navbar />
    <div class="container mx-auto mt-7 px-5 lg:px-10 xl:px-14 xl:mt-12 pb-10">
        <div class="flex gap-5 items-center">
            <div class="w-full border border-[#FFA500]"></div>
            <div class="whitespace-nowrap">
                <h1 class="text-xl font-bold lg:text-2xl xl:text-3xl">Celebrities</h1>
            </div>
            <div class="w-full border border-[#FFA500]"></div>
        </div>
        <div class="mt-7 md:mt-10">
            <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-3 gap-y-5">
                @forelse ($celebrities as $item)
                    <a href="/celebrity/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['name']) }}"
                        wire:navigate>
                        <div class="w-full rounded hover:bg-white/5 transition-all">
                            <div class="w-full aspect-[2/3] overflow-hidden rounded">
                                <img loading="lazy"
                                    src="{{ $item['profile_path']
                                        ? env('TMDB_IMAGE_BASE_URL') . $item['profile_path']
                                        : 'https://placehold.co/300x450?text=No+Image' }}"
                                    alt="Poster {{ $item['name'] }}"
                                    class="w-full h-full object-cover object-top transition-all duration-300"
                                    wire:loading.class="blur-sm opacity-70"
                                    wire:target="updateFetchMovies,prevPage,nextPage" />
                            </div>
                            <div class="mt-2 py-2 lg:px-2">
                                <h1 class="truncate text-white font-bold lg:text-xl">{{ $item['name'] }}</h1>
                                <div class="text-xs sm:text-sm lg:text-base text-white/80 leading-tight space-y-1">
                                    @if (!empty($item['known_for_department']))
                                        <p>{{ $item['known_for_department'] }}</p>
                                    @endif

                                    @if (!empty($item['popularity']))
                                        <p class="text-end">{{ number_format($item['popularity'], 1) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
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

                <span class="text-sm">Page {{ number_format($page) }} of {{ number_format($totalPages) }}</span>

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
