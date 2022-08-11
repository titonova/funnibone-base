<?php

namespace App\Http\Livewire;

use App\Models\Joke;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Http\Request;

class AddJokeForm extends Component
{
    use Actions;


    public $openAddJokeModal;

    public $addJokeModalIsOpen;

    public $exampleJokes;

    public $title;
    public $body;
    public $punchline;
    public $jokeFormat = 'two-liner';

    public function mount()
    {
        $this->exampleJokes = [
            'one-liner' => [
                'title' => null,
                'body' => null,
                'punchline' => __('My wife told me to stop impersonating a flamingo. I had to put my foot down')
            ],
            'two-liner' => [
                'title' => __('Why did the chicken cross the road?'),
                'body' => null,
                'punchline' => __('To see what the joke was about!'),

            ],
            'long'  => [
                'title' => __('A Mormon and an Irishman are on a plane.'),
                'body' => __("A Mormon was seated next to an Irishman on a flight from London to the US. After the plane was airborne, drink orders were taken. The Irishman asked for a whiskey, which was promptly brought and placed before him. The flight attendant then... "),
                'punchline' => __('The Irishman then handed his drink back to the attendant and said, Me, too, I didnt know we had a choice.')
            ]
        ];
    }

    public function openAddJokeModal()
    {
        $this->addJokeModalIsOpen = true;
    }

    public function rules()
    {
        switch ($this->jokeFormat) {
            case 'one-liner':
                return [
                    'title' => 'nullable',
                    'body' => 'nullable',
                    'punchline' => 'required'
                ];
                break;
            case 'two-liner':
                return [
                    'title' => 'required',
                    'body' => 'nullable',
                    'punchline' => 'required'
                ];
                break;
            case 'long':
                return [
                    'title' => 'required',
                    'body' => 'required',
                    'punchline' => 'required'
                ];
                break;
            default:
                trigger_error('Invalid joke format', E_USER_ERROR);
                break;
        }

    }
    public function addJoke(Request $request)
    {
        $this->validate();
        Joke::create([
            'title' => $this->title,
            'body' => $this->body,
            'punchline' => $this->punchline,
            'joke_format' => $this->jokeFormat,
        ]);

        $this->addJokeModalIsOpen = false;
        $this->title = $this->punchline = $this->body = '';
        $this->emitUp('jokeAdded');
        $this->notification()->success(
          __('Joke added successfully!'),
        );

        }
    public function render()
    {
        return view('livewire.add-joke-form');
    }
}
