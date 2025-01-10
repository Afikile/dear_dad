<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Rules\ProhibitedWords;


class ProhibitedWords implements Rule
{
    protected $prohibitedWords = ['badword1', 'badword2', 'inappropriate'];

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
        return 'Your letter contains prohibited words. Please revise it.';
    }
}
