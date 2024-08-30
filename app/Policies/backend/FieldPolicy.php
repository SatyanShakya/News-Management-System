<?php

namespace App\Policies\backend;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     * @return bool
     */
    public function  viewAny(User $user): bool
    {
        return $user->roles()->whereHas("permissions", function ($query) {
            $query->where("slug", 'seo-view');
        })->exists();
    }

    public function view(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'seo-view');
        })->exists();
    }

    public function create(User $user): bool{
        return $user->roles()->whereHas('permissions', function ($query){
            $query->where('slug', 'seo-create');
        })->exists();
    }

    public function update(User $user): bool{
        return $user->roles()->whereHas('permissions', function ($query){
            $query->where('slug', 'seo-edit');
        })->exists();
    }

    public function delete(User $user): bool{
        return $user->roles()->whereHas('permissions', function ($query){
            $query->where('slug', 'seo-delete');
        })->exists();
    }
}
