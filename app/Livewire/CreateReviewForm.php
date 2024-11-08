<?php

namespace App\Livewire;

use Livewire\Component;

class CreateReviewForm extends Component
{
    public $movie;
    public $message;
    public $rating;

    public function mount($movie, $message)
    {
        //
    }

    public function render()
    {
        return view('livewire.create-review-form');
    }
}
