<?php

namespace App\Livewire;

use App\Services\UserService;
use App\Traits\SubscriptionTrait;
use Livewire\Component;

class SubscriptionForm extends Component
{
    use SubscriptionTrait;

    private $userService;

    public $step = 1;
    public $cardNumberMask = "";
    public $cardExpiry = null;

    // default data
    public $data = [
        'subscription_type' => 'free',
        'country' => 'ae',
        'address_2' => null,
        'postal_code' => null,
        'state' => null,
    ];

    /**
     * Boot the SubscriptionForm component.
     *
     * Initialize the UserService with the current data and card number mask.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->userService = new UserService($this->data, $this->cardNumberMask);
    }

    /**
     * Initialize the component.
     *
     * Set the default values for the expiry month and year.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->data['expiry_month'] = (int) date('m');
        $this->data['expiry_year'] = (int) date('Y');
        $this->data['cardExpiry'] = date('Y-m');
    }

    /**
     * Mask the card number and store it in cardNumberMask.
     *
     * @return void
     */
    public function creditCardMasking()
    {
        $this->cardNumberMask = $this->maskCardNumber($this->data['card_number']);
    }

    /**
     * Check the card expiry month and year.
     *
     * @return void
     */
    public function creditCardExpiry()
    {
        $this->cardExpiry = $this->checkCardExpiry($this->data['expiry_year'], $this->data['expiry_month']);
    }

    /**
     * Check the card expiry.
     *
     * @param  int  $year
     * @param  int  $month
     * @return string|null
     */
    private function checkCardExpiry(int $year, int $month): ?string
    {
        // Check if the card expiry is valid
        $date = \Carbon\Carbon::createFromDate($year, $month, 1);
        if ($date->diffInDays(\Carbon\Carbon::today()) > 0) {
            return $date->format('Y-m');
        }

        // If the card expiry is invalid, return null
        return null;
    }

    /**
     * Move to the next step.
     *
     * Validate the current step with the defined rules,
     * and move to the next step.
     *
     * If the current step is 2 and the subscription type is 'free',
     * we move to step 4 directly.
     *
     * @return void
     */
    public function nextStep()
    {
        $this->validateStep();

        if ($this->step === 2 && $this->data['subscription_type'] === 'free') {
            $this->step = 4;
        } else {
            $this->step++;
        }
    }

    /**
     * Move to the previous step.
     *
     * If the current step is 4 and the subscription type is 'free',
     * we move to step 2 directly.
     *
     * @return void
     */
    public function prevStep()
    {
        if ($this->step === 4 && $this->data['subscription_type'] === 'free') {
            $this->step = 2;
        } else {
            $this->step--;
        }
    }

    /**
     * Validate the current step with the defined rules.
     *
     * @return void
     */
    private function validateStep()
    {
        $validate = match ($this->step) {
            1 => SubscriptionRules::stepOne(),
            2 => SubscriptionRules::stepTwo(),
            3 => SubscriptionRules::stepThree(),
            default => [],
        };

        logger()->info("validate_step_{$this->step}", $validate);
        $this->validate($validate['rules'], $validate['messages']);
    }

    /**
     * Handle the form submission.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit()
    {
        logger()->info("submit", $this->data);
        $validate = match ($this->data['subscription_type']) {
            'free' => SubscriptionRules::freeRules(),
            'premium' => SubscriptionRules::premiumRules(),
            default => [],
        };

        logger()->info("validate_step_{$this->step}", $validate);
        $this->validate($validate['rules'], $validate['messages']);

        $this->userService->saveData();

        session()->flash('message', 'You have Subscribed successfully!');
        return redirect()->to('/');
    }


    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.subscription-form');
    }
}
