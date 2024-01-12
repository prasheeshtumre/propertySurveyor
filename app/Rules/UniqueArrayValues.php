<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueArrayValues implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Ensure the value is an array
        if (!is_array($value)) {
            return false;
        }

        // Check if all values in the array are unique
        return count($value) === count(array_unique($value));
    }   

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'All values in the array must be unique.';
    }
}
