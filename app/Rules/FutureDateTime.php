<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FutureDateTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $eventDateTime = \Carbon\Carbon::parse($value);
        $now = \Carbon\Carbon::now();
        
        // Add a 5-minute buffer to account for any processing time
        if ($eventDateTime->lte($now->addMinutes(5))) {
            $fail('The :attribute must be at least 5 minutes in the future from now.');
        }
    }
}
