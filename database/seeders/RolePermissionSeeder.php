<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'view-post', 'create-post', 'update-post', 'delete-post',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $admin = Role::create(['name' => 'Admin']);
        $editor = Role::create(['name' => 'Editor']);
        $admin->permissions()->attach(Permission::all());
        $editor->permissions()->attach(Permission::where('name', 'view-post')->orWhere('name', 'create-post')->get());
    }
}
