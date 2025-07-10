<div class="mb-10">
    <livewire:navbar />
    <livewire:carousel />
    <div class="container mx-auto mt-7 px-5 lg:px-10 xl:px-14 xl:mt-12">
        <div>
            <livewire:top-rated />
        </div>
        <div class="mt-5">
            <livewire:now-playing />
        </div>
        <div class="mt-5">
            <livewire:trending-celebrities />
        </div>
        <div class="mt-5">
            <livewire:upcoming />
        </div>
        {{-- <div class="mt-5 lg:flex lg:gap-5 xl:gap-10 w-full lg:max-h-[500px] lg:overflow-hidden">
            <div class="hidden lg:block lg:w-2/3">
                <livewire:upcoming />
            </div>
            <div class="lg:w-1/3">
                <livewire:trending-celebrities />
            </div>
            <div class="block lg:hidden lg:w-2/3">
                <livewire:upcoming />
            </div>
        </div> --}}
    </div>
</div>
