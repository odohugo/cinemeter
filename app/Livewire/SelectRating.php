<?php

namespace App\Livewire;

use Livewire\Component;

class SelectRating extends Component
{

    public $rating;

    public function mount($rating)
    {
        $this->rating = $rating;
    }

    public function setRating($value)
    {
        $this->rating = $value;
    }

    public function render()
    {
        return view('livewire.select-rating', ['rating' => $this->rating]);
    }
}
