<?php

namespace App\Policies\backend;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAny(User $user):bool{
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'author-view');
        })->exists();
    }

    public function create (User $user): bool{
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'author-create');
        })->exists();
    }

    public function update (User $user): bool{
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'author-edit');
        })->exists();
    }

    public function delete (User $user): bool{
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'author-delete');
        })->exists();
    }
}
