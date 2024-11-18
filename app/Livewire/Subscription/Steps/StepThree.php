<?php

namespace App\Livewire\Subscription\Steps;

use Livewire\Component;

class StepThree extends Component
{

    public $card_number = null;
    public $expiry_month = null;
    public $expiry_year = null;
    public $cvv = null;

    public function render()
    {
        return view('livewire.subscription.steps.step-three');
    }
}
