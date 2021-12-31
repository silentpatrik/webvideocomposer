<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RenderPipeline;
use Illuminate\Auth\Access\HandlesAuthorization;

class RenderPipelinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the renderPipeline can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list renderpipelines');
    }

    /**
     * Determine whether the renderPipeline can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RenderPipeline  $model
     * @return mixed
     */
    public function view(User $user, RenderPipeline $model)
    {
        return $user->hasPermissionTo('view renderpipelines');
    }

    /**
     * Determine whether the renderPipeline can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create renderpipelines');
    }

    /**
     * Determine whether the renderPipeline can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RenderPipeline  $model
     * @return mixed
     */
    public function update(User $user, RenderPipeline $model)
    {
        return $user->hasPermissionTo('update renderpipelines');
    }

    /**
     * Determine whether the renderPipeline can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RenderPipeline  $model
     * @return mixed
     */
    public function delete(User $user, RenderPipeline $model)
    {
        return $user->hasPermissionTo('delete renderpipelines');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RenderPipeline  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete renderpipelines');
    }

    /**
     * Determine whether the renderPipeline can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RenderPipeline  $model
     * @return mixed
     */
    public function restore(User $user, RenderPipeline $model)
    {
        return false;
    }

    /**
     * Determine whether the renderPipeline can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RenderPipeline  $model
     * @return mixed
     */
    public function forceDelete(User $user, RenderPipeline $model)
    {
        return false;
    }
}
