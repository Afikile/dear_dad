<?php

namespace App\Policies;

use App\Models\Letter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LetterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can update the letter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Letter $letter)
    {
        return $user->id === $letter->user_id;
    }

    /**
     * Determine if the user can delete the letter.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Letter $letter)
    {
        return $user->id === $letter->user_id;
    }
}

