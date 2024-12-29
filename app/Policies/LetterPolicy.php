<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Letter;

class LetterPolicy
{
    /**
     * Determine if the given letter can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Letter  $letter
     * @return bool
     */
    public function update(User $user, Letter $letter)
    {
        // Allow the user to update only their own letters
        return $user->id === $letter->user_id;
    }

    /**
     * Determine if the given letter can be deleted by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Letter  $letter
     * @return bool
     */
    public function delete(User $user, Letter $letter)
    {
        // Allow the user to delete only their own letters
        return $user->id === $letter->user_id;
    }
}
