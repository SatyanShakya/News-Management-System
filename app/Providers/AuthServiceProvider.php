<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\post;
use App\Models\Role;
use App\Models\User;
use App\Models\Field;
use App\Models\Author;
use App\Models\category;
use App\Models\Permision;
use App\Policies\backend\PagePolicy;
use App\Policies\backend\PostPolicy;
use App\Policies\backend\RolePolicy;
use App\Policies\backend\UserPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\backend\FieldPolicy;
use App\Policies\backend\AuthorPolicy;
use App\Policies\backend\CategoryPolicy;
use App\Policies\backend\PermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class=> PostPolicy::class,
        Page::class => PagePolicy::class,
        Category::class=>CategoryPolicy::class,
        Author::class => AuthorPolicy::class,
        User::class => UserPolicy::class,
        Role::class=>RolePolicy::class,
        Permision::class=>PermissionPolicy::class,
        Field::class=>FieldPolicy::class,


    ];



    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("post-view", [PostPolicy::class,'viewAny']);
        Gate::define("post-create", [PostPolicy::class,'create']);
        Gate::define("post-edit", [PostPolicy::class,'update']);
        Gate::define("post-delete", [PostPolicy::class,'delete']);

        Gate::define('page-view', [PagePolicy::class,'viewAny']);
        Gate::define('page-create', [PagePolicy::class,'create']);
        Gate::define('page-edit', [PagePolicy::class,'update']);
        Gate::define('page-delete', [PagePolicy::class,'delete']);

        Gate::define('category-view', [CategoryPolicy::class,'viewAny']);
        Gate::define('category-create', [CategoryPolicy::class,'create']);
        Gate::define('category-edit', [CategoryPolicy::class,'update']);
        Gate::define('category-delete', [CategoryPolicy::class,'delete']);

        Gate::define('author-view', [AuthorPolicy::class,'viewAny']);
        Gate::define('author-create', [AuthorPolicy::class,'create']);
        Gate::define('author-edit', [AuthorPolicy::class,'update']);
        Gate::define('author-delete', [AuthorPolicy::class,'delete']);

        Gate::define('user-view', [UserPolicy::class,'viewAny']);
        Gate::define('user-create', [UserPolicy::class,'create']);
        Gate::define('user-edit', [UserPolicy::class,'update']);
        Gate::define('user-delete', [UserPolicy::class,'delete']);


        Gate::define('role-view', [RolePolicy::class,'viewAny']);
        Gate::define('role-create', [RolePolicy::class,'create']);
        Gate::define('role-edit', [RolePolicy::class,'update']);
        Gate::define('role-delete', [RolePolicy::class,'delete']);

        Gate::define('permission-view', [PermissionPolicy::class,'viewAny']);

        Gate::define('seo-view',[FieldPolicy::class,'viewAny']);
        Gate::define('seo-create',[FieldPolicy::class,'create']);
        Gate::define('seo-edit',[FieldPolicy::class,'update']);
        Gate::define('seo-delete',[FieldPolicy::class,'delete']);





    }
}
