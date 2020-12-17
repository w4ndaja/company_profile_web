<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

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
            'create user',
            'update user',
            'delete user',

            'create role',
            'update role',
            'delete role',
            'asign role',

            'create permission',
            'update permission',
            'delete permission',
            'asign permission',

            'create menu',
            'update menu',
            'delete menu',
            'update others menu',
            'delete others menu',

            'create static page',
            'update static page',
            'delete static page',
            'update others static page',
            'delete others static page',

            'create category',
            'update category',
            'delete category',
            'update others category',
            'delete others category',

            'create tag',
            'update tag',
            'delete tag',
            'update others tag',
            'delete others tag',

            'create post',
            'update post',
            'delete post',
            'publish post',
            'update others post',
            'delete others post',
            'publish others post',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
