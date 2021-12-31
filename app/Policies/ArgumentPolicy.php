<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Argument;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArgumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the argument can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list arguments');
    }

    /**
     * Determine whether the argument can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Argument  $model
     * @return mixed
     */
    public function view(User $user, Argument $model)
    {
        return $user->hasPermissionTo('view arguments');
    }

    /**
     * Determine whether the argument can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create arguments');
    }

    /**
     * Determine whether the argument can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Argument  $model
     * @return mixed
     */
    public function update(User $user, Argument $model)
    {
        return $user->hasPermissionTo('update arguments');
    }

    /**
     * Determine whether the argument can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Argument  $model
     * @return mixed
     */
    public function delete(User $user, Argument $model)
    {
        return $user->hasPermissionTo('delete arguments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Argument  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete arguments');
    }

    /**
     * Determine whether the argument can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Argument  $model
     * @return mixed
     */
    public function restore(User $user, Argument $model)
    {
        return false;
    }

    /**
     * Determine whether the argument can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Argument  $model
     * @return mixed
     */
    public function forceDelete(User $user, Argument $model)
    {
        return false;
    }
}
