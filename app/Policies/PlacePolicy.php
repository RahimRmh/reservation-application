<?php

namespace App\Policies;

use App\Models\User;
use App\Models\place;
use Illuminate\Auth\Access\Response;

class PlacePolicy
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
    public function view(User $user, place $place)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->role === 'admin' ? 
        Response::allow() :
        Response::deny('you dont have permission to add place');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->role === 'admin' ? 
        Response::allow() :
        Response::deny('you dont have permission to update place');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->role === 'admin' ? 
        Response::allow() :
        Response::deny('you dont have permission to delete place');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, place $place)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, place $place)
    {
        //
    }
}
