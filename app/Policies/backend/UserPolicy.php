<?php

namespace App\Policies\backend;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'user-view');
        })->exists();
    }

    public function view(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'user-view');
        })->exists();
    }

    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'user-create');
        })->exists();
    }
    public function update(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'user-edit');
        })->exists();
    }

    public function delete(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'user-delete');
        })->exists();
    }
}
