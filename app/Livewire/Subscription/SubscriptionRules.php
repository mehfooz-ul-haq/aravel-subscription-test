<?php

namespace App\Livewire\Subscription;

class SubscriptionRules
{

  public static function freeRules() {
    return array_merge(
      self::stepOne(),
      self::stepTwo(),
      self::stepThree(),
    );
  }

  public static function premiumRules() {
    return array_merge(
      self::stepOne(),
      self::stepTwo()
    );
  }

  public static function stepOne(): array
  {
    return [
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'subscription_type' => 'required',
    ];
  }

  public static function stepTwo(): array
  {
    return [
      'address_1' => 'required',
      'address_2' => 'required',
      'postal_code' => 'required',
      'state' => 'required',
      'country' => 'required',
    ];
  }

  public static function stepThree(): array
  {
    return [
      // 'formData.name' => 'required|min:5',
      // 'formData.email' => 'required|email',
      // 'formData.phone' => 'required|min:10',
      // 'formData.subscription_type' => 'required',
    ];
  }

}
