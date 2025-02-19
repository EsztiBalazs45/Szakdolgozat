<?php

namespace App\Policies;

use App\Models\User;
use App\Models\data;
use App\Models\Dowloaddata;
use Illuminate\Auth\Access\Response;

class DataPolicy
{
    function before(User $user){
        if ($user->role === 'admin') {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Dowloaddata $data): bool
    {
        return $user->id === $data->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Dowloaddata $data): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Dowloaddata $data): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Dowloaddata $data): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Dowloaddata $data): bool
    {
        return false;
    }
}
