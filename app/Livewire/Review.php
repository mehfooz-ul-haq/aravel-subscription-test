<?php

namespace App\Livewire;

use Livewire\Component;

class Review extends Component
{
    public $data;
    public $cardNumberMask;

    public function render()
    {
        return view('livewire.review');
    }
}
