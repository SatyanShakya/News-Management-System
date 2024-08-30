<?php
namespace App\Policies\backend;

use App\Models\User;
use App\Models\post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'post-view');
        })->exists();
    }

    public function view(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'post-view');
        })->exists();
    }

    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'post-create');
        })->exists();
    }
    public function update(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'post-edit');
        })->exists();
    }

    public function delete(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('slug', 'post-delete');
        })->exists();
    }
}
