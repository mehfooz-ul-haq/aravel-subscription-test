<?php

namespace App\Livewire;

use App\Rules\CreditCard;
use App\Rules\FutureDateRule;

class SubscriptionRules
{

  /**
   * Get the validation rules for the premium subscription.
   *
   * @return array
   */
  public static function freeRules()
  {
    $rules = array_merge(
      self::stepOne()['rules'],
      self::stepTwo()['rules'],
    );

    $messages = array_merge(
      self::stepOne()['messages'],
      self::stepTwo()['messages'],
    );

    return ['rules' => $rules, 'messages' => $messages];
  }

  /**
   * Get the validation rules for the premium subscription.
   *
   * @return array
   */
  public static function premiumRules()
  {
    $rules = array_merge(
      self::stepOne()['rules'],
      self::stepTwo()['rules'],
      self::stepThree()['rules'],
    );

    $messages = array_merge(
      self::stepOne()['messages'],
      self::stepTwo()['messages'],
      self::stepThree()['messages'],
    );

    return ['rules' => $rules, 'messages' => $messages];
  }

  /**
   * Get the validation rules and messages for step one of the subscription process.
   *
   * @return array An array containing the validation rules and messages.
   */
  public static function stepOne(): array
  {
    return [
      'rules' => [
        'data.name' => 'required|min:3',
        'data.email' => 'required|email|unique:users,email',
        'data.phone' => 'required|min:10|regex:/^\+?[0-9]\d{1,14}$/',
        'data.subscription_type' => 'required',
      ],
      'messages' => [
        'data.name' => 'required',
        'data.email' => 'required',
        'data.email.unique' => 'Email address already exists.',
        'data.phone' => 'required',
        'data.subscription_type' => 'required',
      ]
    ];
  }

  /**
   * Get the validation rules and messages for step two of the subscription process.
   *
   * @return array An array containing the validation rules and messages.
   */
  public static function stepTwo(): array
  {
    return [
      'rules' => [
        'data.country' => 'required',
        'data.address_1' => 'required',
        'data.address_2' => 'nullable',
        'data.state' => 'required_if:data.country,us,uk',
        'data.postal_code' => 'required_if:data.country,us,uk',
      ],
      'messages' => [
        'data.address_1' => 'required',
        'data.postal_code' => 'required',
        'data.state' => 'required',
        'data.country' => 'required',
      ]
    ];
  }

  /**
   * Get the validation rules and messages for step three of the subscription process.
   *
   * @return array An array containing the validation rules and messages.
   */
  public static function stepThree(): array
  {
    $minYear = date('Y');

    return [
      'rules' => [
        'data.card_number' => ['required', 'size:16', new CreditCard],
        'data.expiry_year' => ['required', 'integer', 'min:' . $minYear],
        'data.expiry_month' => ['required', 'integer', 'between:1,12'],
        'data.cvv' => ['required', 'size:3'],
      ],
      'messages' => [
        'data.card_number.size' => 'Card Number should be 16 digits',
        'data.expiry_month' => 'required',
        'data.expiry.year' => 'required',
        'data.cvv' => 'required',
        'data.cvv.size' => 'CVV should be exactly 3 digits',
      ]
    ];
  }


}
