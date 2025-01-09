<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProhibitedWords implements Rule
{
    private $prohibitedWords = [
        'badword1', 'badword2', 'badword3', // Add more words to the list
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->prohibitedWords as $word) {
            if (stripos($value, $word) !== false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute contains prohibited words.';
    }
}