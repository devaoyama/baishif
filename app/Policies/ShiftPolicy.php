<?php

namespace App\Policies;

use App\Shift;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShiftPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shift  $shift
     * @return bool
     */
    public function view(User $user, Shift $shift)
    {
        return $user->id == $shift->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shift  $shift
     * @return bool
     */
    public function update(User $user, Shift $shift)
    {
        return $user->id == $shift->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shift  $shift
     * @return bool
     */
    public function delete(User $user, Shift $shift)
    {
        return $user->id == $shift->user_id;
    }
}
