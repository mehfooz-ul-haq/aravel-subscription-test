<?php

namespace App\Livewire\Subscription\Steps;

use App\Livewire\Subscription\SubscriptionRules;
use Livewire\Component;

class StepTwo extends Component
{

    public $address_1 = null;
    public $address_2 = null;
    public $postal_code = null;
    public $state = null;
    public $country = null;

    public $listeners = ['nextStep' => 'nextStep', 'previousStep' => 'previousStep'];

    public function emitNextStep()
    {
        $this->validate(SubscriptionRules::stepTwo());

        $data = [
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'postal_code' => $this->postal_code,
            'state' => $this->state,
            'country' => $this->country,
        ];
        $this->dispatch('nextStep', 3, $data);
    }

    public function emitPrevStep()
    {
        $this->dispatch('previousStep', 1);
    }

    public function render()
    {
        return view('livewire.subscription.steps.step-two');
    }
}
