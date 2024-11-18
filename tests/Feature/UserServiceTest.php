<?php

use App\Models\User;
use App\Models\Address;
use App\Models\Payment;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('saves user and address for free subscriptions', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john.doe@example.com',
        'phone' => '1234567890',
        'subscription_type' => 'free',
        'country' => 'us',
        'address_1' => '123 Main St',
        'address_2' => 'Apt 4B',
        'postal_code' => '90210',
        'state' => 'CA',
    ];

    $service = new UserService($data, '**** **** **** ****');

    $service->saveData();

    $this->assertDatabaseHas('users', [
        'email' => 'john.doe@example.com',
        'subscription_type' => 'free',
    ]);

    $this->assertDatabaseHas('addresses', [
        'country' => 'us',
        'address_1' => '123 Main St',
        'postal_code' => '90210',
    ]);

    $this->assertDatabaseMissing('payments', [
        'card_number' => '**** **** **** ****',
    ]);
});

it('saves user, address, and payment for premium subscriptions', function () {
    $data = [
        'name' => 'Jane Smith',
        'email' => 'jane.smith@example.com',
        'phone' => '0987654321',
        'subscription_type' => 'premium',
        'country' => 'us',
        'address_1' => '456 Elm St',
        'address_2' => '',
        'postal_code' => 'A1B2C3',
        'state' => 'ON',
        'expiry_month' => '12',
        'expiry_year' => '2030',
        'cvv' => '123',
    ];

    $maskedCardNumber = '**** **** **** 1234';
    $service = new UserService($data, $maskedCardNumber);

    $service->saveData();

    $this->assertDatabaseHas('users', [
        'email' => 'jane.smith@example.com',
        'subscription_type' => 'premium',
    ]);

    $this->assertDatabaseHas('addresses', [
        'country' => 'us',
        'address_1' => '456 Elm St',
        'postal_code' => 'A1B2C3',
    ]);

    $this->assertDatabaseHas('payments', [
        'card_number' => '**** **** **** 1234',
        'expiry_month' => '12',
        'expiry_year' => '2030',
    ]);
});
