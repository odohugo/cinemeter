<?php

namespace App\Livewire;

use Livewire\Component;

class LikesCounter extends Component
{

    public $review;
    public $userId;
    public $toggled;

    public function mount($review, $userId)
    {
        $this->review = $review;
        $this->userId = $userId;
        $this->toggled = $this->review->likes()->where('user_id', $this->userId)->exists();
    }

    public function toggle()
    {
        if (!$this->review->likes()->where('user_id', $this->userId)->exists()) {
            $this->review->likes()->attach($this->userId);
            $this->toggled = true;
        } else {
            $this->review->likes()->detach($this->userId);
            $this->toggled = false;
        }
        $this->review->save();
        $this->review->load('likes');
    }

    public function render()
    {
        return view('livewire.likes-counter', ['likes' => $this->review->likes()->count(), 'toggled' => $this->toggled]);
    }
}
