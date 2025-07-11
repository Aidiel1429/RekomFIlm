<div x-data="{ scrollCast: null, scrollSimilar: null, scrollRecom: null, scrollReview: null }" x-init="scrollCast = $refs.scrollCast, scrollSimilar = $refs.scrollSimilar, scrollRecom = $refs.scrollRecom, scrollReview = $refs.scrollReview">
    <livewire:navbar />
    <div loading="lazy" class="w-full flex-shrink-0 relative bg-center bg-cover h-40 sm:h-56 lg:h-[450px] xl:h-[550px]"
        style="background-image: url('{{ env('TMDB_IMAGE_BASE_URL') }}{{ $details['backdrop_path'] }}');">

        <div class="absolute inset-0 bg-black/85 bg-dots-pattern"></div>

        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-transparent z-10 "></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10 "></div>

        <div
            class="relative z-10 justify-center h-full w-full px-5 py-5 md:py-10 lg:justify-center md:container md:mx-auto lg:px-10 xl:px-14 xl:mt-12">
            <div class="lg:flex lg:gap-10 xl:flex xl:items-center xl:px-14">
                <img src="{{ $details['poster_path'] ? env('TMDB_IMAGE_BASE_URL') . $details['poster_path'] : 'https://placehold.co/130x200?text=No+Poster' }}"
                    alt="Poster {{ $details['title'] }}"
                    class="w-[100px] rounded shadow-md sm:w-[120px] lg:w-[200px] lg:h-[250px] xl:w-[300px] xl:h-[400px]">
                <div class="hidden lg:block">
                    <h1 class="font-bold text-white lg:text-4xl xl:text-5xl">
                        {{ $details['title'] }}
                    </h1>
                    <p class="text-lg">{{ $details['tagline'] }}</p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($details['genres'] as $genre)
                            <div class="flex items-center gap-2 text-lg">
                                <a href="{{ url('/genres/' . $type . '/' . Str::slug($genre['name'])) }}"
                                    class="hover:text-[#FFA500] hover:underline transition-all">
                                    {{ $genre['name'] }}
                                </a>
                                @if (!$loop->last)
                                    |
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <p class="text-sm md:text-lg">{{ $details['overview'] }}</p>
                        <div class="flex items-center gap-5 mt-2 text-sm md:text-lg">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-star text-yellow-500"></i>
                                {{ number_format($details['vote_average'], 1, ',', '') }}
                            </div>
                            <div>|</div>
                            <p>{{ \Carbon\Carbon::parse($details['release_date'])->format('d M Y') }}</p>
                            <div>|</div>
                            <p>{{ $details['runtime'] }} min</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto mt-7 px-5 pb-10 lg:px-10 xl:px-14 xl:mt-12">
            <h1 class="text-2xl font-bold text-white mt-3 md:text-3xl lg:hidden">
                {{ $details['title'] }}
            </h1>
            <p class="md:text-lg lg:hidden">{{ $details['tagline'] }}</p>
            <div class="mt-2 flex flex-wrap gap-2 lg:hidden">
                @foreach ($details['genres'] as $genre)
                    <div class="flex items-center gap-2 md:text-lg">
                        <a href="{{ url('/genres/' . $type . '/' . Str::slug($genre['name'])) }}"
                            class="hover:text-[#FFA500] hover:underline transition-all">
                            {{ $genre['name'] }}
                        </a>
                        @if (!$loop->last)
                            |
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-4 lg:hidden">
                <p class="text-sm md:text-lg">{{ $details['overview'] }}</p>
                <div class="flex items-center gap-5 mt-2 text-sm md:text-lg">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-star text-yellow-500"></i>
                        {{ number_format($details['vote_average'], 1, ',', '') }}
                    </div>
                    <div>|</div>
                    <p>{{ \Carbon\Carbon::parse($details['release_date'])->format('d M Y') }}</p>
                    <div>|</div>
                    <p>{{ $details['runtime'] }} min</p>
                </div>
            </div>
            <div class="lg:flex lg:gap-10">
                <div class="mt-4 lg:hidden">
                    <div class="text-sm grid grid-cols-2 gap-2 md:text-lg">
                        <div>
                            <h1 class="font-semibold">Budget</h1>
                            <p>{{ '$' . number_format($details['budget'], 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold">Revenue</h1>
                            <p>{{ '$' . number_format($details['revenue'], 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold">Status</h1>
                            <p>{{ $details['status'] }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold">Original Language</h1>
                            <p>{{ $details['original_language'] }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold">Popularity</h1>
                            <p>{{ $details['popularity'] }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold">Vote Count</h1>
                            <p>{{ number_format($details['vote_count'], 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold">Production Country</h1>
                            @if (!empty($details['production_countries']))
                                @foreach ($details['production_countries'] as $item)
                                    <div class="flex items-center gap-2 lg:text-lg">
                                        <p class="">
                                            {{ $item['name'] }}
                                        </p>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="mt-2 md:text-lg">
                        <h2 class="font-semibold text-white mb-1">External Links</h2>
                        <div class="flex flex-wrap gap-3 text-2xl">
                            @if (!empty($details['external_ids']['imdb_id']))
                                <a href="https://www.imdb.com/title/{{ $details['external_ids']['imdb_id'] }}"
                                    target="_blank" class="text-yellow-400 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-imdb"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['wikidata_id']))
                                <a href="https://www.wikidata.org/wiki/{{ $details['external_ids']['wikidata_id'] }}"
                                    target="_blank" class="text-blue-300 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-wikipedia-w"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['facebook_id']))
                                <a href="https://facebook.com/{{ $details['external_ids']['facebook_id'] }}"
                                    target="_blank" class="text-blue-500 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['instagram_id']))
                                <a href="https://instagram.com/{{ $details['external_ids']['instagram_id'] }}"
                                    target="_blank" class="text-pink-500 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['twitter_id']))
                                <a href="https://twitter.com/{{ $details['external_ids']['twitter_id'] }}"
                                    target="_blank" class="text-blue-400 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            @endif

                            @if (!empty($details['homepage']))
                                <a href="{{ $details['homepage'] }}" target="_blank"
                                    class=" hover:underline flex items-center gap-1">
                                    <i class="fa-solid fa-link text-xl xl:text-3xl"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="lg:w-2/3">
                    <div class="mt-4">
                        <h1 class="font-bold text-xl lg:text-2xl xl:text-3xl">Trailer</h1>
                        @if ($trailerUrl)
                            <div class="aspect-video mt-1 rounded overflow-hidden">
                                <iframe
                                    class="w-full h-full sm:w-[500px] sm:h-[300px] md:w-[600px] md:h-[400px] lg:w-full lg:h-full"
                                    src="{{ $trailerUrl }}" title="Movie Trailer" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="w-full text-center text-white opacity-60">
                                <img src="https://placehold.co/480x270?text=No+Trailer+Available" alt="No Trailer"
                                    class="mx-auto mt-2 rounded">
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 lg:mt-7">
                        <div class="lg:flex lg:justify-between items-center">
                            <h1 class="font-bold text-xl lg:text-2xl xl:text-3xl">Cast</h1>
                            <div class="hidden lg:flex items-center gap-2">
                                <button @click="scrollCast.scrollBy({ left: -300, behavior: 'smooth' })"
                                    class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                        class="fa-solid fa-chevron-left"></i></button>
                                <button @click="scrollCast.scrollBy({ left: 300, behavior: 'smooth' })"
                                    class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>
                        </div>
                        <div x-ref="scrollCast"
                            class="mt-2 overflow-x-auto scroll-smooth no-scrollbar snap-x snap-mandatory md:mt-4 lg:mt-4">
                            <div class="flex items-end gap-5 min-w-max">
                                @forelse ($details['credits']['cast'] as $item)
                                    <a
                                        href="/celebrity/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['name']) }}">
                                        <div
                                            class="flex flex-col justify-start text-center snap-start flex-shrink-0 w-[130px] h-[250px] lg:w-[150px] lg:h-[270px] xl:w-[180px] xl:h-[300px]">
                                            <div
                                                class="w-[130px] h-[130px] mx-auto overflow-hidden rounded border border-white/20 lg:w-[150px] lg:h-[150px] xl:w-[180px] xl:h-[180px]">
                                                <img loading="lazy"
                                                    src="{{ $item['profile_path']
                                                        ? env('TMDB_IMAGE_BASE_URL') . $item['profile_path']
                                                        : 'https://ui-avatars.com/api/?name=' . urlencode($item['name']) . '&background=DBDBDB&color=333' }}"
                                                    class="w-full h-full object-cover object-top"
                                                    alt="Photo {{ $item['name'] }}">
                                            </div>
                                            <div class="mt-4 leading-tight text-start">
                                                <p class="font-bold text-white md:text-lg xl:text-xl leading-5">
                                                    {{ $item['name'] }}
                                                </p>
                                                <p class="text-sm text-white/80 lg:text-base xl:text-lg">
                                                    {{ $item['character'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-center text-white">No casts found</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    @if (count($details['similar']['results']) > 0)
                        <div class="mt-4 lg:mt-7">
                            <div class="lg:flex lg:justify-between items-center">
                                <h1 class="font-bold text-xl lg:text-2xl xl:text-3xl">Similar Movies</h1>
                                <div class="hidden lg:flex items-center gap-2">
                                    <button @click="scrollSimilar.scrollBy({ left: -300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-left"></i></button>
                                    <button @click="scrollSimilar.scrollBy({ left: 300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div x-ref="scrollSimilar"
                                class="mt-3 overflow-x-auto scroll-smooth no-scrollbar snap-x snap-mandatory md:mt-4 lg:mt-4">
                                <div class="flex gap-5 min-w-max">
                                    @foreach ($details['similar']['results'] as $item)
                                        <a href="/movie/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['title']) }}"
                                            wire:navigate>
                                            <div
                                                class="w-[130px] flex-shrink-0 snap-start rounded overflow-hidden bg-black">
                                                <div class="h-[200px]">
                                                    <img src="{{ $item['poster_path'] ? env('TMDB_IMAGE_BASE_URL') . $item['poster_path'] : 'https://placehold.co/130x200?text=No+Poster' }}"
                                                        alt="Poster {{ $item['title'] }}"
                                                        class="w-full h-full object-cover object-top rounded" />
                                                </div>
                                                <div class="mt-2 text-start">
                                                    <p
                                                        class="font-semibold text-white text-sm leading-tight line-clamp-2 md:text-base xl:text-xl">
                                                        {{ $item['title'] }}
                                                    </p>
                                                    <p class="text-xs text-white/70 md:text-sm xl:text-lg">
                                                        {{ \Carbon\Carbon::parse($item['release_date'])->format('Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (count($details['recommendations']['results']) > 0)
                        <div class="mt-4 lg:mt-7">
                            <div class="lg:flex lg:justify-between items-center">
                                <h1 class="font-bold text-xl lg:text-2xl xl:text-3xl">Recomended Movies</h1>
                                <div class="hidden lg:flex items-center gap-2">
                                    <button @click="scrollRecom.scrollBy({ left: -300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-left"></i></button>
                                    <button @click="scrollRecom.scrollBy({ left: 300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div x-ref="scrollRecom"
                                class="mt-3 overflow-x-auto scroll-smooth no-scrollbar snap-x snap-mandatory md:mt-4 lg:mt-4">
                                <div class="flex gap-5 min-w-max">
                                    @foreach ($details['recommendations']['results'] as $item)
                                        <a href="/movie/{{ $item['id'] }}/{{ \Illuminate\Support\Str::slug($item['title']) }}"
                                            wire:navigate>
                                            <div
                                                class="w-[130px] flex-shrink-0 snap-start rounded overflow-hidden bg-black">
                                                <div class="h-[200px]">
                                                    <img src="{{ $item['poster_path'] ? env('TMDB_IMAGE_BASE_URL') . $item['poster_path'] : 'https://placehold.co/130x200?text=No+Poster' }}"
                                                        alt="Poster {{ $item['title'] }}"
                                                        class="w-full h-full object-cover object-top rounded" />
                                                </div>
                                                <div class="mt-2 text-start">
                                                    <p
                                                        class="font-semibold text-white text-sm leading-tight line-clamp-2  md:text-base xl:text-xl">
                                                        {{ $item['title'] }}
                                                    </p>
                                                    <p class="text-xs text-white/70 md:text-sm xl:text-lg">
                                                        {{ \Carbon\Carbon::parse($item['release_date'])->format('Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (count($details['reviews']['results']) > 0)
                        <div class="mt-4 lg:mt-7">
                            <div class="lg:flex lg:justify-between items-center">
                                <h1 class="font-bold text-xl lg:text-2xl xl:text-3xl">Reviews</h1>
                                <div class="hidden lg:flex items-center gap-2">
                                    <button @click="scrollReview.scrollBy({ left: -300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-left"></i></button>
                                    <button @click="scrollReview.scrollBy({ left: 300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div x-ref="scrollReview"
                                class="mt-3 overflow-x-auto scroll-smooth no-scrollbar snap-x snap-mandatory md:mt-4 lg:mt-4">
                                <div class="flex gap-5 min-w-max">
                                    @foreach ($details['reviews']['results'] as $item)
                                        <a href="{{ $item['url'] }}" target="_blank">
                                            <div
                                                class="w-[280px] h-[160px] flex-shrink-0 snap-start rounded overflow-hidden border border-white/20 bg-black p-3 xl:w-[300px] xl:h-[180px]">
                                                <div
                                                    class="font-semibold text-white flex items-center justify-between xl:text-xl">
                                                    <div class="max-w-[150px]">
                                                        <h1 class="truncate leading-snug">{{ $item['author'] }}
                                                        </h1>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <i class="fa-solid fa-star text-yellow-500"></i>
                                                        {{ number_format($item['author_details']['rating'], 1) }}
                                                    </div>
                                                </div>
                                                <div class="mt-2 xl:mt-3">
                                                    <p
                                                        class="text-sm text-white/80 line-clamp-5 leading-snug xl:text-base">
                                                        {{ $item['content'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mt-4 hidden lg:block lg:w-1/3">
                    <div class="mt-2 md:text-lg">
                        <div class="flex flex-wrap gap-3">
                            @if (!empty($details['external_ids']['imdb_id']))
                                <a href="https://www.imdb.com/title/{{ $details['external_ids']['imdb_id'] }}"
                                    target="_blank" class="text-yellow-400 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-imdb text-xl xl:text-3xl"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['wikidata_id']))
                                <a href="https://www.wikidata.org/wiki/{{ $details['external_ids']['wikidata_id'] }}"
                                    target="_blank" class="text-blue-300 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-wikipedia-w text-xl xl:text-3xl"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['facebook_id']))
                                <a href="https://facebook.com/{{ $details['external_ids']['facebook_id'] }}"
                                    target="_blank" class="text-blue-500 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-facebook text-xl xl:text-3xl"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['instagram_id']))
                                <a href="https://instagram.com/{{ $details['external_ids']['instagram_id'] }}"
                                    target="_blank" class="text-pink-500 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-instagram text-xl xl:text-3xl"></i>
                                </a>
                            @endif

                            @if (!empty($details['external_ids']['twitter_id']))
                                <a href="https://twitter.com/{{ $details['external_ids']['twitter_id'] }}"
                                    target="_blank" class="text-blue-400 hover:underline flex items-center gap-1">
                                    <i class="fa-brands fa-twitter text-xl xl:text-3xl"></i>
                                </a>
                            @endif

                            @if (!empty($details['homepage']))
                                <a href="{{ $details['homepage'] }}" target="_blank"
                                    class=" hover:underline flex items-center gap-1">
                                    <i class="fa-solid fa-link text-xl xl:text-3xl"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="text-lg mt-4">
                        <div class="mt-2">
                            <h1 class="font-semibold">Budget</h1>
                            <p class="ml-2">{{ '$' . number_format($details['budget'], 0, ',', '.') }}</p>
                        </div>
                        <div class="mt-2">
                            <h1 class="font-semibold">Revenue</h1>
                            <p class="ml-2">{{ '$' . number_format($details['revenue'], 0, ',', '.') }}</p>
                        </div>
                        <div class="mt-2">
                            <h1 class="font-semibold">Status</h1>
                            <p class="ml-2">{{ $details['status'] }}</p>
                        </div>
                        <div class="mt-2">
                            <h1 class="font-semibold">Original Language</h1>
                            <p class="ml-2">{{ $details['original_language'] }}</p>
                        </div>
                        <div class="mt-2">
                            <h1 class="font-semibold">Production Country</h1>
                            @if (!empty($details['production_countries']))
                                @foreach ($details['production_countries'] as $item)
                                    <div class="flex items-center gap-2 ml-2 lg:text-lg">
                                        <p class="">
                                            {{ $item['name'] }}
                                        </p>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                        <div class="mt-2">
                            <h1 class="font-semibold">Popularity</h1>
                            <p class="ml-2">{{ $details['popularity'] }}</p>
                        </div>
                        <div class="mt-2">
                            <h1 class="font-semibold">Vote Count</h1>
                            <p class="ml-2">{{ number_format($details['vote_count'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
