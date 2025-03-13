<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Rating;

class Show extends Component
{
    public $film;
    public $slug;
    public $content;
    public $rating = 5;

    protected $rules = [
        'content' => 'required|min:10',
        'rating' => 'required|numeric|min:1|max:5'
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->loadFilm();
        
        if (!$this->film) {
            return redirect()->route('home')->with('error', 'Film not found!');
        }
    }

    public function loadFilm()
    {
        // Load with eager loading for better performance
        $this->film = Film::with(['comments.user'])
            ->where('slug', $this->slug)
            ->first();
    }

    // Add explicit method for star rating
    public function setRating($value)
    {
        $this->rating = $value;
    }

    public function addComment()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $this->validate();

        Comment::create([
            'film_id' => $this->film->id,
            'user_id' => Auth::id(),
            'content' => $this->content,

        ]);

        Rating::create([
            'film_id' => $this->film->id,
            'user_id' => Auth::id(),
            'rating' => $this->rating
        ]);

        // Add a flash message for better user experience
        session()->flash('message', 'Your review has been added successfully!');
        
        $this->reset('content');
        $this->rating = 5;
        $this->loadFilm();
    }

    public function render()
    {
        return view('livewire.home.show');
    }
}