<?php

namespace App\Policies\backend;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     * @return bool
     */
   public function viewAny(User $user):bool {

    return $user->roles()->whereHas('permissions', function ($query) {
        $query->where('slug', 'permission-view');
    })->exists();

   }
}
