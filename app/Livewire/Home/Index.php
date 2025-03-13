<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Film;

class Index extends Component
{
    public $loading = false;
    
    public function viewFilmDetails($slug)
    {
        $this->loading = true;
        return redirect()->route('film.show', ['slug' => $slug]);
    }

    public function render()
    {
        return view('livewire.home.index', [
            'films' => Film::all()
        ]);
    }
}
