<div class="relative"  x-data="{placeholder: @entangle('searchType')}">
    <flux:input.group>
        <flux:select size="sm" class="max-w-22" wire:model.live="searchType">
            <flux:select.option value="Tahun Rilis">Tahun Rilis</flux:select.option>
            <flux:select.option value="Genre">Genre</flux:select.option>
            <flux:select.option value="Judul">Judul</flux:select.option>
        </flux:select>
    
        <flux:input size="sm"
            wire:model.live.debounce.300ms="query" 
            placeholder="{{ 'Masukkan ' . $searchType }}" 
            class="w-36 md:w-32"
            @focus="$wire.showResults = $wire.query.length >= 2"
            @click.outside="$wire.showResults = false"
        />
    </flux:input.group>

    @if($showResults && count($results) > 0)
        <div class="absolute mt-1 w-full bg-gray-800 rounded-lg shadow-lg z-50 max-h-96 overflow-y-auto">
            <ul class="py-1">
                @foreach($results as $film)
                    <li>
                        <a 
                            href="{{ route('film.show', $film->slug) }}" 
                            class="block px-4 py-2 hover:bg-gray-700 transition"
                            wire:navigate
                            wire:click="resetSearch"
                        >
                            <div class="flex items-center">
                                @if($film->poster)
                                    <img src="{{ '/storage/' . $film->poster }}" alt="{{ $film->title }}" class="h-10 w-16 object-cover rounded mr-3">
                                @endif
                                <div>
                                    <div class="text-sm font-medium">{{ $film->title }}</div>
                                    <div class="text-xs text-gray-400">
                                        {{ $film->release_year }}
                                        @if($film->genres->count() > 0)
                                            · {{ $film->genres->first() }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @elseif($showResults && strlen($query) >= 2)
        <div class="absolute mt-1 w-full bg-gray-800 rounded-lg shadow-lg z-50 p-3 text-center">
            <p class="text-sm text-gray-400">{{ __('No results found for ":query"', ['query' => $query]) }}</p>
        </div>
    @endif
</div>