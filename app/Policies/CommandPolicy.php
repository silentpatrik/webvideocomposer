<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Command;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the command can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list commands');
    }

    /**
     * Determine whether the command can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Command  $model
     * @return mixed
     */
    public function view(User $user, Command $model)
    {
        return $user->hasPermissionTo('view commands');
    }

    /**
     * Determine whether the command can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create commands');
    }

    /**
     * Determine whether the command can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Command  $model
     * @return mixed
     */
    public function update(User $user, Command $model)
    {
        return $user->hasPermissionTo('update commands');
    }

    /**
     * Determine whether the command can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Command  $model
     * @return mixed
     */
    public function delete(User $user, Command $model)
    {
        return $user->hasPermissionTo('delete commands');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Command  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete commands');
    }

    /**
     * Determine whether the command can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Command  $model
     * @return mixed
     */
    public function restore(User $user, Command $model)
    {
        return false;
    }

    /**
     * Determine whether the command can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Command  $model
     * @return mixed
     */
    public function forceDelete(User $user, Command $model)
    {
        return false;
    }
}
