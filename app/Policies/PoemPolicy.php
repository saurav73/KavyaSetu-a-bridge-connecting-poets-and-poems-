<?php

namespace App\Policies;

use App\Models\Poem;
use App\Models\User;

class PoemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Poem $poem): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Poem $poem): bool
    {
        return $user->id === $poem->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Poem $poem): bool
    {
        return $user->id === $poem->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Poem $poem): bool
    {
        return $user->id === $poem->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Poem $poem): bool
    {
        return $user->id === $poem->user_id;
    }
}
