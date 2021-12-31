<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the page can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list pages');
    }

    /**
     * Determine whether the page can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Page  $model
     * @return mixed
     */
    public function view(User $user, Page $model)
    {
        return $user->hasPermissionTo('view pages');
    }

    /**
     * Determine whether the page can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create pages');
    }

    /**
     * Determine whether the page can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Page  $model
     * @return mixed
     */
    public function update(User $user, Page $model)
    {
        return $user->hasPermissionTo('update pages');
    }

    /**
     * Determine whether the page can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Page  $model
     * @return mixed
     */
    public function delete(User $user, Page $model)
    {
        return $user->hasPermissionTo('delete pages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Page  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete pages');
    }

    /**
     * Determine whether the page can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Page  $model
     * @return mixed
     */
    public function restore(User $user, Page $model)
    {
        return false;
    }

    /**
     * Determine whether the page can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Page  $model
     * @return mixed
     */
    public function forceDelete(User $user, Page $model)
    {
        return false;
    }
}
