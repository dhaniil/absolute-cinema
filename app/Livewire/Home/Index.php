<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Film;

class Index extends Component
{


    public function render()
    {
        return view('livewire.home.index', [
            'films' => Film::all()
        ]);
    }
}
