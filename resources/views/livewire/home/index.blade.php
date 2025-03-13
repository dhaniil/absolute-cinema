<div class="min-h-screen bg-gray-900">
    <div id="hero" class="flex flex-col lg:flex-row w-full text-white items-center bg-gradient-to-r from-black via-transparent to-black p-6">
        <div class="h-auto sm:max-w-full lg:flex-1/2 items-start flex flex-col gap-2 px-auto">
            <span class="text-sm font-semibold bg-red-500 rounded-md p-1">Film Populer</span>
            <h1 class="font-sans font-normal text-4xl">Judul Film Panjang</h1>
            <div class="flex flex-row gap-4 items-center">
                <span class="bg-white/90 text-black p-2 text-sm rounded-md font-bold">Action Sci/Fi</span>
                <span class="bg-yellow-500 p-2 text-sm font-bold rounded-md ">2 Jam</span>
            </div>
            <p class="font-normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <div class="flex flex-col lg:flex-row gap-6">
                <div class="flex flex-row w-fit items-center bg-red-500 p-2 rounded-md gap-2 ">
                    <flux:icon.play class="size-8"></flux:icon.play>
                    <span>Tonton Sekarang</span>
                </div>
                <div class="flex flex-row items-center bg-transparent border-2 border-solid border-white gap-2 p-2 rounded-md ">
                    <flux:icon.info></flux:icon.info>
                    <span>Sinopsis</span>
                </div>
            </div>

        </div>
        <div class="w-full lg:w-1/2">
            <img src="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba" alt="" class="object-cover rounded-xl h-auto w-auto" />
        </div>
    </div>
    <div id="film-section">
        <div class="container mx-auto p-6">
            <h1 class="text-sans text-4xl font-semibold m-4">Film Section</h1>
            <div wire:poll.200ms  
                class="flex gap-6 p-6 bg-gray-100/10 rounded-md 
                       overflow-x-auto scrollbar-hide">
                @foreach( $films as $film)
                    <div wire:click="viewFilmDetails('{{$film->slug}}')" 
                         wire:loading.class="opacity-50"
                         id="film-card" 
                         class="relative w-[150px] sm:w-[200px] lg:w-[300px] 
                                max-h-[400px] flex-shrink-0 group 
                                overflow-hidden rounded-md cursor-pointer
                                scroll-snap-align: start">
                        <img src="{{ '/storage/' . $film->poster }}" 
                            alt="Film Poster" 
                            class="object-cover rounded-md h-auto w-full group-hover:scale-105 transition-all duration-300" />
                        <div class="absolute inset-0 bottom-0 left-0 right-0 
                                    bg-gradient-to-b from-transparent to-black/50 
                                    p-2 opacity-0 transition-opacity group-hover:opacity-100 duration-300 
                                    flex items-end">
                            <h1 class="text-center font-semibold text-sm sm:text-lg lg:text-2xl w-full">
                                {{$film->title}}
                            </h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container mx-auto p-6">
            <h1 class="text-sans text-4xl font-semibold m-4">Film Section 2</h1>
            <div wire:poll.200ms  
                class="flex gap-6 p-6 bg-gray-100/10 rounded-md 
                       overflow-x-auto scrollbar-hide" 
                style="scroll-snap-type: x mandatory;">
                @foreach( $films as $film)
                    <div wire:click="viewFilmDetails('{{$film->slug}}')"
                         wire:loading.class="opacity-50"
                         wire:target="viewFilmDetails('{{$film->slug}}')"
                         class="relative w-[150px] sm:w-[200px] lg:w-[300px] 
                                max-h-[400px] flex-shrink-0 group 
                                overflow-hidden rounded-md cursor-pointer
                                scroll-snap-align: start">
                        <img src="{{ '/storage/' . $film->poster }}" 
                            alt="Film Poster" 
                            class="object-cover rounded-md h-auto w-full group-hover:scale-105 transition-all duration-300" />
                        <div class="absolute inset-0 bottom-0 left-0 right-0 
                                    bg-gradient-to-b from-transparent to-black/50 
                                    p-2 opacity-0 transition-opacity group-hover:opacity-100 duration-300 
                                    flex items-end">
                            <h1 class="text-center font-semibold text-sm sm:text-lg lg:text-2xl w-full">
                                {{$film->title}}
                            </h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
</div>
