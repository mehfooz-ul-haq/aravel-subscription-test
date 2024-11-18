<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Payment;
use App\Models\User;

class UserService
{
    private array $data;
    private string $cardNumberMask;

    /**
     * Initialize the UserService with the current data and card number mask.
     *
     * @param  array  $data
     * @param  string  $cardNumberMask
     */
    public function __construct(array $data, string $cardNumberMask)
    {
        $this->data = $data;
        $this->cardNumberMask = $cardNumberMask;
    }

    /**
     * Save the user data.
     *
     * Extract the user data and save it to the database.
     * Extract the address data and save it to the database.
     * If the subscription type is 'premium', extract the payment data
     * and save it to the database.
     *
     * @return void
     */
    public function saveData(): void
    {
        // Create a new user with the extracted data
        $user = User::create($this->extractUserData());

        // Save the address data for the new user
        $user->address()->save(new Address($this->extractAddressData()));

        // Save the payment data for the new user if the subscription type is 'premium'
        if ($this->isPremiumSubscription()) {
            $user->payment()->save(new Payment($this->extractPaymentData($user->id)));
        }
    }
    /**
     * Extract the user data from the input array.
     *
     * @return array The extracted user data
     */
    private function extractUserData(): array
    {
        return [
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'phone' => $this->data['phone'],
            'subscription_type' => $this->data['subscription_type'],
        ];
    }

    /**
     * Extract the address data from the input array.
     *
     * @return array The extracted address data
     */
    private function extractAddressData(): array
    {
        return [
            'country' => $this->data['country'],
            'address_1' => $this->data['address_1'],
            'address_2' => $this->data['address_2'],
            'postal_code' => $this->data['postal_code'],
            'state_province' => $this->data['state'],
        ];
    }

    /**
     * Extract the payment data for the specified user.
     *
     * @param int $userId The ID of the user
     * @return array The extracted payment data
     */
    private function extractPaymentData(int $userId): array
    {
        return [
            'user_id' => $userId,
            'card_number' => $this->cardNumberMask,
            'expiry_month' => $this->data['expiry_month'],
            'expiry_year' => $this->data['expiry_year'],
            'cvv' => $this->data['cvv'],
        ];
    }

    /**
     * Determine if the subscription is a premium subscription.
     *
     * @return bool True if it is a premium subscription, false if it is not
     */
    private function isPremiumSubscription(): bool
    {
        return $this->data['subscription_type'] === 'premium';
    }
}
