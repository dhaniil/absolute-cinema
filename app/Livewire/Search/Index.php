<?php

namespace App\Livewire\Search;

use App\Models\Film;
use Livewire\Component;
use App\Models\Genre;

class Index extends Component
{
    public $query = '';
    public $results = [];
    public $showResults = false;
    public $searchType = 'Judul';

    public function updatedQuery()
    {
        if(strlen($this->query) < 2) {
            $this->results = [];
            $this->showResults = false;
            return;
        }

        switch($this->searchType) {
            case 'Judul':
                $this->results = Film::where('title', 'like', '%'.$this->query.'%')->get();
                break;
                
            case 'Tahun Rilis':
                $this->results = Film::where('release_year', 'like', '%'.$this->query.'%')->get();
                break;
                
            case 'Genre':
                $genre = Genre::where('name', 'like', '%'.$this->query.'%')->first();
                
                if ($genre) {
                    $this->results = Film::whereJsonContains('genre_id', $genre->id)->get();
                } else {
                    $this->results = collect();
                }
                break;
        }
        
        $this->showResults = true;
    }

    public function resetSearch()
    {
        $this->query = '';
        $this->results = [];
        $this->showResults = false;
    }

    public function render()
    {
        return view('livewire.search.index');
    }
}
