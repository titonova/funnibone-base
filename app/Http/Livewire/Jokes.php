<?php

namespace App\Http\Livewire;

use App\Models\Joke;
use Livewire\Component;

class Jokes extends Component
{

    public $jokes;

    protected $listeners = ['jokeAdded' => '$refresh'];

    public function render()
    {
        $this->jokes = Joke::all()->sortByDesc('created_at');
        return view('livewire.jokes');
    }
}
