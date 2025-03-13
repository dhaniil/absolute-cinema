<div class="bg-gray-900 p-6 text-white min-h-screen">
    @if ($film)
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-1/3">
             <img src="{{'/storage/' . $film->poster}}" alt="{{$film->title}}" class="object-cover rounded-xl h-auto w-auto" />
        </div>
        <div class="flex flex-col w-full lg:w-2/3 gap-4">
            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-2">
                <h1 class="text-sans text-4xl font-light">{{$film->title}}</h1>
                <span class="bg-yellow-500 p-2 rounded-md text-sm font-normal ">{{$film->release_year}}</span>
            </div>
            <div class="flex flex-row gap-2">
                @foreach($film->genres as $genre)
                <span class="bg-gray-100/20 px-3 py-1 rounded-md text-sm">
                    {{ $genre }}
                </span>
                @endforeach            
            </div>
            <h2 class="text-sans text-2xl font-normal">Sinopsis:</h2>
            <div class="bg-gray-100/20 p-4 rounded-md">
                <p class="text-sm font-light italic">{{$film->synopsis}}</p>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="mt-10">
        <h2 class="text-sans text-2xl font-normal mb-6">Reviews</h2>
        
        <!-- Display existing reviews -->
        @if($film->comments && $film->comments->count() > 0)
            <div class="space-y-4 mb-8">
                @foreach($film->comments as $comment)
                    <div class="bg-gray-800 p-4 rounded-md">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="font-bold">{{ $comment->user->name }}</span>
                                <span class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $i <= $comment->rating ? 'text-yellow-500' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm">{{ $comment->content }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 mb-6">No reviews yet. Be the first to leave a review!</p>
        @endif
        
        <!-- Add review form -->
        @auth
            <div class="bg-gray-800 p-6 rounded-md">
                <h3 class="text-xl mb-4">Add Your Review</h3>
                
                @if (session('message'))
                    <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                        {{ session('message') }}
                    </div>
                @endif
                
                <form wire:submit.prevent="addComment">
                    <div class="mb-4">
                        <label class="block mb-2">Rating:</label>
                        <div class="flex space-x-2">
                            @for($i = 1; $i <= 5; $i++)
                                <button 
                                    type="button" 
                                    wire:click="$set('rating', {{ $i }})" 
                                    class="focus:outline-none"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 {{ $i <= $rating ? 'text-yellow-500' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block mb-2">Your Review:</label>
                        <textarea 
                            wire:model="content" 
                            class="w-full px-3 py-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" 
                            rows="4"
                            placeholder="Share your thoughts about this film..."
                        ></textarea>
                        @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded-md transition duration-300">
                        Submit Review
                    </button>
                </form>
            </div>
        @else
            <div class="bg-gray-800 p-4 rounded-md text-center">
                <p>Please <a href="{{ route('login') }}" class="text-yellow-500 hover:underline">login</a> to leave a review.</p>
            </div>
        @endauth
    </div>
    @endif
</div>