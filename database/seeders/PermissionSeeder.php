<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Permision;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'Post Create', 'slug' => 'post-create'],
            ['name' => 'Author Create', 'slug' => 'author-create'],
            ['name' => 'Category Create', 'slug' => 'category-create'],
            ['name' => 'Page Create', 'slug' => 'page-create'],
            ['name' => 'Role Create', 'slug' => 'role-create'],
            ['name' => 'User Create', 'slug' => 'user-create'],
            ['name' => 'SEO Create', 'slug' => 'seo-create'],


            ['name' => 'Post Edit', 'slug' => 'post-edit'],
            ['name' => 'Author Edit', 'slug' => 'author-edit'],
            ['name' => 'Category Edit', 'slug' => 'category-edit'],
            ['name' => 'Page Edit', 'slug' => 'page-edit'],
            ['name' => 'Role Edit', 'slug' => 'role-edit'],
            ['name' => 'User Edit', 'slug' => 'user-edit'],
            ['name' => 'SEO Edit', 'slug' => 'seo-edit'],


            ['name' => 'Post Delete', 'slug' => 'post-delete'],
            ['name' => 'Author Delete', 'slug' => 'author-delete'],
            ['name' => 'Category Delete', 'slug' => 'category-delete'],
            ['name' => 'Page Delete', 'slug' => 'page-delete'],
            ['name' => 'Role Delete', 'slug' => 'role-delete'],
            ['name' => 'User Delete', 'slug' => 'user-delete'],
            ['name' => 'SEO Delete', 'slug' => 'seo-delete'],


            ['name' => 'Post View', 'slug' => 'post-view'],
            ['name' => 'Author View', 'slug' => 'author-view'],
            ['name' => 'Category View', 'slug' => 'category-view'],
            ['name' => 'Page View', 'slug' => 'page-view'],
            ['name' => 'Role View', 'slug' => 'role-view'],
            ['name' => 'User View', 'slug' => 'user-view'],
            ['name' => 'Permission View', 'slug' => 'permission-view'],
            ['name' => 'SEO View', 'slug' => 'seo-view'],

        ];

        DB::table('permisions')->insert($permissions);
    }
}
