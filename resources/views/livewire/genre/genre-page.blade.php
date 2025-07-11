<div>
    <livewire:navbar />

    <div class="container mx-auto  px-5 lg:px-10 xl:px-14 pb-10">
        <div class="flex gap-5 items-center mt-7">
            <div class="w-full border border-[#FFA500]"></div>
            <div class="whitespace-nowrap">
                <h1 class="text-xl font-bold lg:text-2xl xl:text-3xl capitalize">{{ str_replace('-', ' ', $slug) }}</h1>
            </div>
            <div class="w-full border border-[#FFA500]"></div>
        </div>
        <div class="mt-10 grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-3 gap-y-5">
            @forelse ($datas as $item)
                <a @if ($type == 'movie') href="/movie/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['title']) }}" 
                    @elseif ($type == 'tv') href="/tv-series/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['title']) }}" @endif
                    wire:navigate>
                    <div class="w-full">
                        <div class="w-full aspect-[2/3] overflow-hidden rounded">
                            <img loading="lazy"
                                src="{{ $item['poster_path']
                                    ? env('TMDB_IMAGE_BASE_URL') . $item['poster_path']
                                    : 'https://placehold.co/300x450?text=No+Image' }}"
                                alt="Poster {{ $item['title'] }}"
                                class="w-full h-full object-cover object-top transition-all duration-300"
                                wire:loading.class="blur-sm opacity-70" wire:target="prevPage,nextPage" />
                        </div>
                        <div class="mt-2">
                            <h1 class="truncate text-white font-bold lg:text-xl">
                                {{ $item['title'] }}
                            </h1>
                            <p class="text-xs lg:text-base">
                                {{ \Carbon\Carbon::parse($item['release_date'])->format('Y') }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="w-full text-center text-white col-span-full">No data found</div>
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
