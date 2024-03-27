<?php

namespace App\Policies;

use App\Models\User;
use App\Models\resturant;
use Illuminate\Auth\Access\Response;

class ResturantPolicy
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
    public function view(User $user, resturant $resturant)
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
        Response::deny('you dont have permission to add user');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->role === 'admin' ? 
        Response::allow() :
        Response::deny('you dont have permission to update user');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->role === 'admin' ? 
        Response::allow() :
        Response::deny('you dont have permission to delete user');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, resturant $resturant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, resturant $resturant)
    {
        //
    }
}
