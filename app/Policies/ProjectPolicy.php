<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the project can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list projects');
    }

    /**
     * Determine whether the project can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Project  $model
     * @return mixed
     */
    public function view(User $user, Project $model)
    {
        return $user->hasPermissionTo('view projects');
    }

    /**
     * Determine whether the project can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create projects');
    }

    /**
     * Determine whether the project can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Project  $model
     * @return mixed
     */
    public function update(User $user, Project $model)
    {
        return $user->hasPermissionTo('update projects');
    }

    /**
     * Determine whether the project can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Project  $model
     * @return mixed
     */
    public function delete(User $user, Project $model)
    {
        return $user->hasPermissionTo('delete projects');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Project  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete projects');
    }

    /**
     * Determine whether the project can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Project  $model
     * @return mixed
     */
    public function restore(User $user, Project $model)
    {
        return false;
    }

    /**
     * Determine whether the project can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Project  $model
     * @return mixed
     */
    public function forceDelete(User $user, Project $model)
    {
        return false;
    }
}
