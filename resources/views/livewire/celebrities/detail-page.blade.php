<div x-data="{ scrollPhotos: null, scrollCareer: null }" x-init="scrollPhotos = $refs.scrollPhotos, scrollCareer = $refs.scrollCareer">
    <livewire:navbar />

    <div class="container mx-auto mt-7 px-5 lg:px-10 xl:px-14 xl:mt-12 pb-10">
        <div>
            <div class="sm:flex items-center gap-5 md:gap-10 xl:px-20">
                <img loading="lazy"
                    src="{{ $details['profile_path']
                        ? env('TMDB_IMAGE_BASE_URL') . $details['profile_path']
                        : 'https://placehold.co/300x450?text=No+Image' }}"
                    alt="Poster {{ $details['name'] }}"
                    class="w-[100px] rounded shadow-md sm:w-[150px] md:w-[200px] lg:w-[250px] xl:w-[300px] xl:h-[400px]">

                <div class="mt-4 grid grid-cols-2 gap-2 w-full lg:hidden">
                    <div>
                        <h1 class="font-semibold text-white md:text-xl">Name</h1>
                        <p>{{ $details['name'] }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold text-white md:text-xl">Gender</h1>
                        @if ($details['gender'] == 0)
                            <p>Not set</p>
                        @elseif ($details['gender'] == 1)
                            <p>Female</p>
                        @elseif ($details['gender'] == 2)
                            <p>Male</p>
                        @else
                            <p>Non-binary</p>
                        @endif
                    </div>
                    <div>
                        <h1 class="font-semibold text-white md:text-xl">Birthday</h1>
                        <p>{{ \Carbon\Carbon::parse($details['birthday'])->format('d M Y') }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold text-white md:text-xl">Deathday</h1>
                        @if ($details['deathday'])
                            <p>{{ \Carbon\Carbon::parse($details['deathday'])->format('d M Y') }}</p>
                        @else
                            <p>-</p>
                        @endif
                    </div>
                    <div>
                        <h1 class="font-semibold text-white md:text-xl">Best Known As</h1>
                        <p>{{ $details['known_for_department'] }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold text-white md:text-xl">Popularity</h1>
                        <p>{{ number_format($details['popularity'], 1) }}</p>
                    </div>
                    <div class="hidden lg:block">
                        <h1 class="font-semibold text-white sm:text-xl">Place of Birth</h1>
                        <p>{{ $details['place_of_birth'] }}</p>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="text-white/90 leading-relaxed max-h-[400px] overflow-y-auto pr-2 xl:text-lg">
                        {{ $details['biography'] }}
                    </div>
                </div>
            </div>
            <div class="mt-2 sm:mt-4 md:mt-6 lg:hidden">
                <h1 class="font-semibold text-white sm:text-xl">Place of Birth</h1>
                <p>{{ $details['place_of_birth'] }}</p>
            </div>
            <div class="mt-2 lg:hidden">
                <h1 class="font-semibold text-white mb-1 sm:text-xl">Biography</h1>
                <div class="text-white/90 leading-relaxed max-h-[200px] overflow-y-auto pr-2">
                    {{ $details['biography'] }}
                </div>
            </div>
            <div class="mt-4 grid-cols-3 gap-2 w-full hidden lg:grid xl:hidden">
                <div>
                    <h1 class="font-semibold text-white md:text-xl">Name</h1>
                    <p>{{ $details['name'] }}</p>
                </div>
                <div>
                    <h1 class="font-semibold text-white md:text-xl">Gender</h1>
                    @if ($details['gender'] == 0)
                        <p>Not set</p>
                    @elseif ($details['gender'] == 1)
                        <p>Female</p>
                    @elseif ($details['gender'] == 2)
                        <p>Male</p>
                    @else
                        <p>Non-binary</p>
                    @endif
                </div>
                <div>
                    <h1 class="font-semibold text-white md:text-xl">Birthday</h1>
                    <p>{{ \Carbon\Carbon::parse($details['birthday'])->format('d M Y') }}</p>
                </div>
                <div>
                    <h1 class="font-semibold text-white md:text-xl">Deathday</h1>
                    @if ($details['deathday'])
                        <p>{{ \Carbon\Carbon::parse($details['deathday'])->format('d M Y') }}</p>
                    @else
                        <p>-</p>
                    @endif
                </div>
                <div>
                    <h1 class="font-semibold text-white md:text-xl">Best Known As</h1>
                    <p>{{ $details['known_for_department'] }}</p>
                </div>
                <div>
                    <h1 class="font-semibold text-white md:text-xl">Popularity</h1>
                    <p>{{ number_format($details['popularity'], 1) }}</p>
                </div>
                <div class="hidden lg:block">
                    <h1 class="font-semibold text-white sm:text-xl">Place of Birth</h1>
                    <p>{{ $details['place_of_birth'] }}</p>
                </div>
            </div>
            @if (!empty($details['also_known_as']))
                <div class="mt-4 xl:hidden">
                    <h1 class="font-semibold text-white mb-1 sm:text-xl">Also Known As</h1>
                    <ul class="text-white/90 list-disc ml-5 sm:text-base">
                        @foreach ($details['also_known_as'] as $alias)
                            <li>{{ $alias }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mt-4 xl:hidden">
                <h1 class="font-semibold text-white sm:text-xl">External Links</h1>
                <div class="flex flex-wrap gap-2 text-2xl md:text-3xl mt-2">
                    @if (!empty($details['external_ids']['imdb_id']))
                        <a href="https://www.imdb.com/title/{{ $details['external_ids']['imdb_id'] }}" target="_blank"
                            class="text-yellow-400 hover:underline flex items-center gap-1">
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
                        <a href="https://facebook.com/{{ $details['external_ids']['facebook_id'] }}" target="_blank"
                            class="text-blue-500 hover:underline flex items-center gap-1">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    @endif

                    @if (!empty($details['external_ids']['instagram_id']))
                        <a href="https://instagram.com/{{ $details['external_ids']['instagram_id'] }}" target="_blank"
                            class="text-pink-500 hover:underline flex items-center gap-1">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif

                    @if (!empty($details['external_ids']['twitter_id']))
                        <a href="https://twitter.com/{{ $details['external_ids']['twitter_id'] }}" target="_blank"
                            class="text-blue-400 hover:underline flex items-center gap-1">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    @endif

                    @if (!empty($details['homepage']))
                        <a href="{{ $details['homepage'] }}" target="_blank"
                            class=" hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-link"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="xl:flex xl gap-10 mt-10">
                <div class="xl:w-2/3">
                    @if (!empty($details['images']['profiles']))
                        <div class="mt-4">
                            <div class="lg:flex lg:justify-between items-center mb-4">
                                <h1 class="font-bold text-xl lg:text-2xl xl:text-3xl text-white">Photos</h1>
                                <div class="hidden lg:flex items-center gap-2">
                                    <button @click="scrollPhotos.scrollBy({ left: -300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-left"></i></button>
                                    <button @click="scrollPhotos.scrollBy({ left: 300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div x-ref="scrollPhotos" class="flex gap-4 overflow-x-auto scroll-smooth no-scrollbar">
                                @foreach ($details['images']['profiles'] as $image)
                                    <div
                                        class="flex-shrink-0 w-24 h-32 rounded overflow-hidden sm:w-36 sm:h-44 lg:w-48 lg:h-60">
                                        <img src="{{ env('TMDB_IMAGE_BASE_URL') . $image['file_path'] }}"
                                            alt="Celebrity photo" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if (!empty($details['combined_credits']['cast']))
                        <div class="mt-4 lg:mt-8">
                            <div class="lg:flex lg:justify-between items-center mb-4">
                                <h1 class="font-bold text-xl lg:text-2xl xl:text-3xl text-white">Career Highlights</h1>
                                <div class="hidden lg:flex items-center gap-2">
                                    <button @click="scrollCareer.scrollBy({ left: -300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-left"></i></button>
                                    <button @click="scrollCareer.scrollBy({ left: 300, behavior: 'smooth' })"
                                        class="h-10 w-10 flex justify-center items-center bg-white/10 rounded-2xl cursor-pointer"><i
                                            class="fa-solid fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div x-ref="scrollCareer" class="flex gap-4 overflow-x-auto no-scrollbar">
                                @foreach ($details['combined_credits']['cast'] as $credit)
                                    <a
                                        href="{{ $credit['media_type'] == 'movie' ? '/movie/' . \Illuminate\Support\Str::slug($credit['title']) : '/tv/' . \Illuminate\Support\Str::slug($credit['name']) }}">
                                        <div class="flex-shrink-0 w-28 sm:w-36 md:w-36 lg:w-48">
                                            <div
                                                class="w-full h-40 rounded overflow-hidden border border-white/10 sm:h-52 lg:h-64">
                                                <img src="{{ $credit['poster_path']
                                                    ? env('TMDB_IMAGE_BASE_URL') . $credit['poster_path']
                                                    : 'https://placehold.co/200x300?text=No+Image' }}"
                                                    alt="{{ $credit['title'] ?? $credit['name'] }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="mt-2 text-white text-sm leading-tight">
                                                <p class="font-semibold line-clamp-2 leading-5 sm:text-lg">
                                                    {{ $credit['title'] ?? $credit['name'] }}
                                                </p>
                                                <p class="text-xs text-white/60 sm:mt-1 sm:text-base">
                                                    {{ \Carbon\Carbon::parse($credit['release_date'] ?? $credit['first_air_date'])->format('Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="xl:w-1/3 hidden xl:block">
                    <div class="mt-4 grid grid-cols-1 gap-2">
                        <div class="flex flex-wrap gap-3 text-3xl mt-2">
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
                                    <i class="fa-solid fa-link"></i>
                                </a>
                            @endif
                        </div>
                        <div>
                            <h1 class="font-semibold text-white md:text-xl xl:text-2xl">Name</h1>
                            <p class="xl:text-lg">{{ $details['name'] }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold text-white xl:text-2xl">Gender</h1>
                            @if ($details['gender'] == 0)
                                <p class="xl:text-lg">Not set</p>
                            @elseif ($details['gender'] == 1)
                                <p class="xl:text-lg">Female</p>
                            @elseif ($details['gender'] == 2)
                                <p class="xl:text-lg">Male</p>
                            @else
                                <p class="xl:text-lg">Non-binary</p>
                            @endif
                        </div>
                        <div>
                            <h1 class="font-semibold text-white md:text-lg xl:text-2xl">Birthday</h1>
                            <p class="xl:text-lg">{{ \Carbon\Carbon::parse($details['birthday'])->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <h1 class="font-semibold text-white md:text-lg xl:text-2xl">Deathday</h1>
                            @if ($details['deathday'])
                                <p class="xl:text-lg">
                                    {{ \Carbon\Carbon::parse($details['deathday'])->format('d M Y') }}</p>
                            @else
                                <p class="xl:text-lg">-</p>
                            @endif
                        </div>
                        <div>
                            <h1 class="font-semibold text-white md:text-lg xl:text-2xl">Best Known As</h1>
                            <p class="xl:text-lg">{{ $details['known_for_department'] }}</p>
                        </div>
                        <div>
                            <h1 class="font-semibold text-white md:text-lg xl:text-2xl">Popularity</h1>
                            <p class="xl:text-lg">{{ number_format($details['popularity'], 1) }}</p>
                        </div>
                        <div class="hidden lg:block">
                            <h1 class="font-semibold text-white sm:text-lg xl:text-2xl">Place of Birth</h1>
                            <p class="xl:text-lg">{{ $details['place_of_birth'] }}</p>
                        </div>
                        @if (!empty($details['also_known_as']))
                            <div>
                                <h1 class="font-semibold text-white mb-1 sm:text-lg xl:text-2xl">Also Known As</h1>
                                <ul class="text-white/90 list-disc ml-5 sm:text-base xl:text-lg">
                                    @foreach ($details['also_known_as'] as $alias)
                                        <li>{{ $alias }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
