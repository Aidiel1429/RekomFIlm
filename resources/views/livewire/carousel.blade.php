<div x-data="{
    baseImageUrl: '{{ env('TMDB_IMAGE_BASE_URL') }}',
    current: 0,
    slides: @js($carousels),
    start() {
        setInterval(() => {
            this.current = (this.current + 1) % this.slides.length;
        }, 4000);
    }
}" x-init="start()" class="relative w-full overflow-hidden">

    <div class="flex transition-transform duration-700 ease-in-out w-full"
        :style="`transform: translateX(-${current * 100}%);`">

        @forelse ($carousels as $carousel)
            <div loading="lazy"
                class="w-full flex-shrink-0 relative bg-center bg-cover h-64 sm:h-80 md:h-96 lg:h-[481px] xl:h-[681px]"
                style="background-image: url('{{ env('TMDB_IMAGE_BASE_URL') }}{{ $carousel['backdrop_path'] }}');">

                <div class="absolute inset-0 bg-black/70 bg-dots-pattern"></div>

                <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-transparent z-10 "></div>

                <div
                    class="relative z-10 flex flex-col justify-end h-full w-full px-5 py-5 text-xl font-medium md:py-10 lg:justify-center md:container md:mx-auto lg:px-10 xl:px-14">
                    <h1 class="text-white text-xl font-bold md:text-3xl xl:text-6xl">{{ $carousel['title'] }}</h1>
                    <div class="mt-2 flex gap-4 text-sm text-white md:text-base xl:text-xl">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-star text-yellow-500"></i>
                            {{ number_format($carousel['vote_average'], 1, ',', '') }}
                        </div>
                        <p>|</p>
                        <p>{{ $carousel['genre'] }}</p>
                    </div>
                    <div>
                        <p class="mt-2 text-sm text-white md:text-base xl:text-xl">
                            {{ \Carbon\Carbon::parse($carousel['release_date'])->format('M d, Y') }}
                        </p>
                    </div>
                    <a href="/movie/{{ $carousel['id'] }}/{{ \Illuminate\Support\Str::slug($carousel['title']) }}"
                        wire:navigate class="mt-2">
                        <button
                            class="bg-white/20 px-3 py-2 rounded-2xl text-sm font-semibold text-white cursor-pointer md:text-lg xl:text-2xl xl:px-5">
                            View Details
                        </button>
                    </a>
                </div>
            </div>
        @empty
            <div class="w-full h-64 flex justify-center items-center">
                <p>No movies found</p>
            </div>
        @endforelse
    </div>
</div>
