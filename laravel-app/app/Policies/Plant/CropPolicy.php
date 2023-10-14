<?php

namespace App\Policies\Plant;

use App\Models\User;
use App\Models\Plant\Crop;
use Illuminate\Auth\Access\HandlesAuthorization;

class CropPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_plant::crop');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plant\Crop  $crop
     * @return bool
     */
    public function view(User $user, Crop $crop): bool
    {
        return $user->can('view_plant::crop');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create_plant::crop');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plant\Crop  $crop
     * @return bool
     */
    public function update(User $user, Crop $crop): bool
    {
        return $user->can('update_plant::crop');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plant\Crop  $crop
     * @return bool
     */
    public function delete(User $user, Crop $crop): bool
    {
        return $user->can('delete_plant::crop');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_plant::crop');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plant\Crop  $crop
     * @return bool
     */
    public function forceDelete(User $user, Crop $crop): bool
    {
        return $user->can('force_delete_plant::crop');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_plant::crop');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plant\Crop  $crop
     * @return bool
     */
    public function restore(User $user, Crop $crop): bool
    {
        return $user->can('restore_plant::crop');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_plant::crop');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plant\Crop  $crop
     * @return bool
     */
    public function replicate(User $user, Crop $crop): bool
    {
        return $user->can('replicate_plant::crop');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_plant::crop');
    }

}
