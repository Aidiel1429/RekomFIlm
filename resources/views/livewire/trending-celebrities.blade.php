<div>
    <h1 class="text-xl font-bold md:text-2xl xl:text-4xl">Trending celebrities</h1>
    <div class="border border-[#FFA500] w-8 md:w-10 xl:w-14 xl:border-2 xl:mt-1"></div>

    <div class="mt-3 overflow-x-auto custom-scroll snap-x snap-mandatory md:mt-7">
        <div class="flex items-end gap-5 min-w-max">
            @forelse ($trendingCelebrities as $item)
                <div
                    class="flex flex-col justify-start text-center snap-start flex-shrink-0 w-[130px] h-[250px] lg:w-[150px] lg:h-[270px] xl:w-[180px] xl:h-[300px]">
                    <div
                        class="w-[130px] h-[130px] mx-auto overflow-hidden rounded-full border border-white/20 lg:w-[150px] lg:h-[150px] xl:w-[180px] xl:h-[180px]">
                        <img src="{{ $item['profile_path']
                            ? env('TMDB_IMAGE_BASE_URL') . $item['profile_path']
                            : 'https://ui-avatars.com/api/?name=' . urlencode($item['name']) . '&background=DBDBDB&color=333&rounded=true' }}"
                            class="w-full h-full object-cover object-top" alt="Photo {{ $item['name'] }}">
                    </div>
                    <div class="mt-4 leading-tight">
                        <p class="text-sm text-white/80 lg:text-base xl:text-lg">{{ $item['known_for_department'] }}</p>
                        <p class="font-bold text-white md:text-lg xl:text-xl leading-5">{{ $item['name'] }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-white">No celebrities found</p>
            @endforelse
        </div>
    </div>
</div>
