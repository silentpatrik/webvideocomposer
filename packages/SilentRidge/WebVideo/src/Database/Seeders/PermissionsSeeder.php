<?php

namespace WebVideo\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use function app;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list arguments']);
        Permission::create(['name' => 'view arguments']);
        Permission::create(['name' => 'create arguments']);
        Permission::create(['name' => 'update arguments']);
        Permission::create(['name' => 'delete arguments']);

        Permission::create(['name' => 'list commands']);
        Permission::create(['name' => 'view commands']);
        Permission::create(['name' => 'create commands']);
        Permission::create(['name' => 'update commands']);
        Permission::create(['name' => 'delete commands']);

        Permission::create(['name' => 'list files']);
        Permission::create(['name' => 'view files']);
        Permission::create(['name' => 'create files']);
        Permission::create(['name' => 'update files']);
        Permission::create(['name' => 'delete files']);

        Permission::create(['name' => 'list pages']);
        Permission::create(['name' => 'view pages']);
        Permission::create(['name' => 'create pages']);
        Permission::create(['name' => 'update pages']);
        Permission::create(['name' => 'delete pages']);

        Permission::create(['name' => 'list projects']);
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'update projects']);
        Permission::create(['name' => 'delete projects']);

        Permission::create(['name' => 'list projectoptions']);
        Permission::create(['name' => 'view projectoptions']);
        Permission::create(['name' => 'create projectoptions']);
        Permission::create(['name' => 'update projectoptions']);
        Permission::create(['name' => 'delete projectoptions']);

        Permission::create(['name' => 'list renderpipelines']);
        Permission::create(['name' => 'view renderpipelines']);
        Permission::create(['name' => 'create renderpipelines']);
        Permission::create(['name' => 'update renderpipelines']);
        Permission::create(['name' => 'delete renderpipelines']);

        Permission::create(['name' => 'list sections']);
        Permission::create(['name' => 'view sections']);
        Permission::create(['name' => 'create sections']);
        Permission::create(['name' => 'update sections']);
        Permission::create(['name' => 'delete sections']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('info@localhost')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
