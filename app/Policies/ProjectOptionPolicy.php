<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use WebVideo\Models\ProjectOption;

class ProjectOptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the projectOption can view any models.
     *
     * @param App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list projectoptions');
    }

    /**
     * Determine whether the projectOption can view the model.
     *
     * @param App\Models\User $user
     * @param App\Models\ProjectOption $model
     * @return mixed
     */
    public function view(User $user, ProjectOption $model)
    {
        return $user->hasPermissionTo('view projectoptions');
    }

    /**
     * Determine whether the projectOption can create models.
     *
     * @param App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create projectoptions');
    }

    /**
     * Determine whether the projectOption can update the model.
     *
     * @param App\Models\User $user
     * @param App\Models\ProjectOption $model
     * @return mixed
     */
    public function update(User $user, ProjectOption $model)
    {
        return $user->hasPermissionTo('update projectoptions');
    }

    /**
     * Determine whether the projectOption can delete the model.
     *
     * @param App\Models\User $user
     * @param App\Models\ProjectOption $model
     * @return mixed
     */
    public function delete(User $user, ProjectOption $model)
    {
        return $user->hasPermissionTo('delete projectoptions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param App\Models\User $user
     * @param App\Models\ProjectOption $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete projectoptions');
    }

    /**
     * Determine whether the projectOption can restore the model.
     *
     * @param App\Models\User $user
     * @param App\Models\ProjectOption $model
     * @return mixed
     */
    public function restore(User $user, ProjectOption $model)
    {
        return false;
    }

    /**
     * Determine whether the projectOption can permanently delete the model.
     *
     * @param App\Models\User $user
     * @param App\Models\ProjectOption $model
     * @return mixed
     */
    public function forceDelete(User $user, ProjectOption $model)
    {
        return false;
    }
}
