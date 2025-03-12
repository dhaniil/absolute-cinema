<div class="min-h-screen bg-gray-900">
    <div id="hero" class="flex flex-col lg:flex-row w-full text-white items-center bg-gradient-to-r from-black via-transparent to-black p-6">
        <div class="h-auto sm:max-w-full lg:flex-1/2 items-start flex flex-col gap-2">
            <span class="text-sm font-semibold bg-red-500 rounded-md p-1">Film Populer</span>
            <h1 class="font-sans font-normal text-4xl">Judul Film Panjang</h1>
            <div class="flex flex-row gap-4 items-center">
                <span class="bg-white/90 text-black p-2 text-sm rounded-md font-bold">Action Sci/Fi</span>
                <span class="bg-yellow-500 p-2 text-sm font-bold rounded-md ">2 Jam</span>
            </div>
            <p class="font-normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <div class="flex flex-row items-center bg-red-500 p-2 rounded-md gap-2">
                <flux:icon.play class="size-8"></flux:icon.play>
                <span>Tonton Sekarang</span>
            </div>
            <div class="flex flex-row items-center bg-transparent border-2 border-solid border-white gap-2 p-2 rounded-md ">
                <flux:icon.info></flux:icon.info>
                <span>Sinopsis</span>
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <img src="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba" alt="" class="object-cover rounded-xl h-auto w-auto" />
        </div>
    </div>
    <div id="film-section">
        <div class="bg-gray-100/10 rounded-md">
            <h1>Film Section</h1>
            @foreach( $films as $film)
                <div class="">
                    <h1>
                        {{ $film->title }}
                    </h1>
                </div>
            @endforeach

        </div>
    </div>
</div>
