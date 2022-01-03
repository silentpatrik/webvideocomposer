<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use WebVideo\Models\Section;

class SectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the section can view any models.
     *
     * @param App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list sections');
    }

    /**
     * Determine whether the section can view the model.
     *
     * @param App\Models\User $user
     * @param App\Models\Section $model
     * @return mixed
     */
    public function view(User $user, Section $model)
    {
        return $user->hasPermissionTo('view sections');
    }

    /**
     * Determine whether the section can create models.
     *
     * @param App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create sections');
    }

    /**
     * Determine whether the section can update the model.
     *
     * @param App\Models\User $user
     * @param App\Models\Section $model
     * @return mixed
     */
    public function update(User $user, Section $model)
    {
        return $user->hasPermissionTo('update sections');
    }

    /**
     * Determine whether the section can delete the model.
     *
     * @param App\Models\User $user
     * @param App\Models\Section $model
     * @return mixed
     */
    public function delete(User $user, Section $model)
    {
        return $user->hasPermissionTo('delete sections');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param App\Models\User $user
     * @param App\Models\Section $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete sections');
    }

    /**
     * Determine whether the section can restore the model.
     *
     * @param App\Models\User $user
     * @param App\Models\Section $model
     * @return mixed
     */
    public function restore(User $user, Section $model)
    {
        return false;
    }

    /**
     * Determine whether the section can permanently delete the model.
     *
     * @param App\Models\User $user
     * @param App\Models\Section $model
     * @return mixed
     */
    public function forceDelete(User $user, Section $model)
    {
        return false;
    }
}
