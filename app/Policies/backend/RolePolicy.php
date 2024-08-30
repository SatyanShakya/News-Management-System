<?php

namespace App\Policies\backend;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
            $query->where('slug', 'role-view');
        })->exists();
    }

    public function view(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'role-view');
        })->exists();
    }

    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'role-create');
        })->exists();
    }
    public function update(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'role-edit');
        })->exists();
    }

    public function delete(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'role-delete');
        })->exists();
    }
}
