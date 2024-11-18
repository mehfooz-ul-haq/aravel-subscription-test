<?php

namespace App\Livewire\Subscription;

use App\Livewire\SubscriptionRules;
use Livewire\Component;

class Subscription extends Component
{
    public $step = 1;
    public $data = [];
    protected $listeners = ['nextStep', 'previousStep'];

    public function nextStep($step, $data)
    {
        // array_push($this->data, $data);
        $this->data[$step] = $data;
        $this->step = $step;
    }

    public function previousStep($step)
    {
        $this->step = $step;
    }

    private function validateFinalStep()
    {
        if ($this->data['subscription_type'] == 'free') {
            $this->validate(SubscriptionRules::freeRules());
            return;
        }
        $this->validate(SubscriptionRules::premiumRules());
    }

    public function submit()
    {
        $this->validateFinalStep();
        session()->flash('message', 'Form submitted successfully!');
    }

    public function render()
    {
        return view('livewire.subscription.form', ['data' => $this->data]);
    }
}
