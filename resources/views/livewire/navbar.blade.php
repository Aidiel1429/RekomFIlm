<div class="container mx-auto p-5 lg:px-10 xl:px-14" x-data="{ isOpenSearch: false, isOpenMenu: false }">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-between space-x-2 gap-4 text-lg xl:text-xl text-white w-full">
            <a href="/" wire:navigate class="adlam text-2xl text-white xl:text-3xl">Sceneza</a>
            <div class="flex items-center gap-5 md:hidden">
                <button x-show="!isOpenSearch" @click="isOpenSearch = true">
                    <i class="fa-solid fa-magnifying-glass cursor-pointer"></i>
                </button>
                <button x-show="isOpenSearch" @click="isOpenSearch = false">
                    <i class="fa-solid fa-xmark cursor-pointer"></i>
                </button>
                <button class="md:hidden" @click="isOpenMenu = true">
                    <i class="fa-solid fa-bars cursor-pointer"></i>
                </button>
            </div>
            <div class="hidden md:flex gap-5 font-medium">
                <a href="/movies" wire:navigate
                    class="{{ request()->routeIs('movies') ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500] transition' }}">
                    Movies
                </a>
                <a href="/tv-series" wire:navigate
                    class="{{ request()->routeIs('tv-series') ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500] transition' }}">
                    Tv Series
                </a>
                <a href="#" class="text-white hover:text-[#FFA500] transition">
                    Top Rated
                </a>
                <a href="#" class="text-white hover:text-[#FFA500] transition">
                    Trending
                </a>
            </div>
            <div class="hidden md:block">
                <input type="text" placeholder="Find a movie..."
                    class="hidden md:block border-2 border-gray-400 outline-none py-2 px-3 text-white rounded-2xl focus:border-[#FFA500] transition-all w-40 xl:w-60">
            </div>
        </div>
    </div>

    <div x-show="isOpenSearch" class="mt-4 md:hidden" x-transition>
        <input type="text" placeholder="Find a movie..."
            class="w-full mt-4 p-2 bg-white text-black rounded-md focus:outline-none">
    </div>

    <div class="fixed top-0 right-0 w-full h-full bg-black text-white z-50 md:hidden" x-show="isOpenMenu"
        x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition transform duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" style="display: none;">
        <div class="flex justify-end p-4">
            <i class="fa-solid fa-xmark text-2xl cursor-pointer" @click="isOpenMenu = false"></i>
        </div>

        <div class="flex flex-col items-center justify-center h-[80%] text-2xl space-y-6">
            <a href="/movies" wire:navigate
                class="{{ request()->routeIs('movies') ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500] transition' }}">
                Movies
            </a>
            <a href="/tv-series" wire:navigate
                class="{{ request()->routeIs('tv-series') ? 'text-[#FFA500]' : 'text-white hover:text-[#FFA500] transition' }}">
                Tv Series
            </a>
            <a href="#" class="hover:text-[#FFA500] transition">Top Rated</a>
            <a href="#" class="hover:text-[#FFA500] transition">Trending</a>
        </div>
    </div>
</div>
