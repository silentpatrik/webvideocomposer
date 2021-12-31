<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the file can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list files');
    }

    /**
     * Determine whether the file can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\File  $model
     * @return mixed
     */
    public function view(User $user, File $model)
    {
        return $user->hasPermissionTo('view files');
    }

    /**
     * Determine whether the file can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create files');
    }

    /**
     * Determine whether the file can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\File  $model
     * @return mixed
     */
    public function update(User $user, File $model)
    {
        return $user->hasPermissionTo('update files');
    }

    /**
     * Determine whether the file can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\File  $model
     * @return mixed
     */
    public function delete(User $user, File $model)
    {
        return $user->hasPermissionTo('delete files');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\File  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete files');
    }

    /**
     * Determine whether the file can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\File  $model
     * @return mixed
     */
    public function restore(User $user, File $model)
    {
        return false;
    }

    /**
     * Determine whether the file can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\File  $model
     * @return mixed
     */
    public function forceDelete(User $user, File $model)
    {
        return false;
    }
}
