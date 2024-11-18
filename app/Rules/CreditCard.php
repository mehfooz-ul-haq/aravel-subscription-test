<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CreditCard implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * Validates a credit card number using the Luhn algorithm.
     * This algorithm is a simple checksum formula used to validate various identification numbers, such as credit card numbers, Canadian Social Insurance Numbers, and US Social Security Numbers.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove any non-digit characters from the value
        $value = preg_replace('/\D/', '', $value);

        $sum = 0;
        $length = strlen($value);
        $parity = $length % 2;

        // Iterate through each character in the value
        for ($i = 0; $i < $length; $i++) {
            $digit = $value[$i];

            if ($i % 2 == $parity) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        // If the sum is not divisible by 10, the number is not valid
        if ($sum % 10 != 0) {
            $fail('Not a valid credit card number.');
        }
    }
}
