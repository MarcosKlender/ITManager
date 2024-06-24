<?php

namespace App\Policies;

use App\Models\Goods;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GoodsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['ADMIN', 'EDITOR', 'LECTOR']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Goods $goods): bool
    {
        return $user->hasRole(['ADMIN', 'EDITOR', 'LECTOR']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['ADMIN', 'EDITOR']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Goods $goods): bool
    {
        return $user->hasRole(['ADMIN', 'EDITOR']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Goods $goods): bool
    {
        return $user->hasRole(['ADMIN']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Goods $goods): bool
    {
        return $user->hasRole(['ADMIN']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Goods $goods): bool
    {
        return $user->hasRole(['ADMIN']);
    }
}
