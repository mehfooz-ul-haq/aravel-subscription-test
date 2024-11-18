<?php

namespace App\Traits;

trait SubscriptionTrait
{
  /**
   * Return an array of countries.
   * source can be DB, but for simplicity, we'll hardcode it here
   *
   * @return array
   */
  public function countries(): array
  {
    return [
      'fr' => 'France',
      'ae' => 'United Arab Emirates',
      'uk' => 'United Kingdom',
      'us' => 'United States',
    ];
  }

  /**
   * Return an array of months.
   *
   * @return array
   */
  public function months(): array
  {
    return [
      1 => 'Jan',
      2 => 'Feb',
      3 => 'Mar',
      4 => 'Apr',
      5 => 'May',
      6 => 'Jun',
      7 => 'Jul',
      8 => 'Aug',
      9 => 'Sep',
      10 => 'Oct',
      11 => 'Nov',
      12 => 'Dec',
    ];
  }

  /**
   * Return a masked version of the given card number.
   *
   * @param string $cardNumber
   * @return string
   */
  public function maskCardNumber(string $cardNumber): string
  {
    // Remove all non-numeric characters
    $cardNumber = preg_replace('/\D/', '', $cardNumber);

    if (strlen($cardNumber) < 16) {
      return '';
    }

    // Get the last 4 digits of the card
    $lastFour = substr($cardNumber, -4);

    // Replace the middle digits with asterisks
    return str_repeat('*', strlen($cardNumber) - 4) . $lastFour;
  }

  /**
   * Check if the given card expiry date is valid or not.
   *
   * @param int $year
   * @param int $month
   * @return boolean
   */
  public function checkCardExpiry(int $year, int $month): bool
  {
    // Get the last day of the month
    $date = date('Y-m-t', strtotime("$year-$month-01"));
    return strtotime($date) < strtotime('now');
  }
}
