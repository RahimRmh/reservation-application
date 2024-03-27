<?php

namespace App\Policies;

use App\Models\User;
use App\Models\reservation;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, reservation $reservation)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, reservation $reservation)
    {
        return $user->id === $reservation->user_id || $user->role === 'admin' ?
        Response::allow() :
         Response::deny('You dont have permission to update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, reservation $reservation)
    {
        return $user->id === $reservation->user_id || $user->role === 'admin' ?
        Response::allow() :
         Response::deny('You dont have permission');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, reservation $reservation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, reservation $reservation)
    {
        //
    }
}
