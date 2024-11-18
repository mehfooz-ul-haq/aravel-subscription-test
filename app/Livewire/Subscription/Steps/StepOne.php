<?php

namespace App\Livewire\Subscription\Steps;

use App\Livewire\SubscriptionRules;
use Livewire\Component;

class StepOne extends Component
{

    public $name = null;
    public $email = null;
    public $phone = null;
    public $subscription_type = 'free';

    public $message = null;

    public $listeners = ['nextStep' => 'nextStep'];

    public function emitNextStep()
    {
        $this->validate(SubscriptionRules::stepOne()['rules']);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subscription_type' => $this->subscription_type,
        ];
        $this->dispatch('nextStep', 2, $data);
    }

    public function render()
    {
        return view('livewire.subscription.steps.step-one');
    }
}
