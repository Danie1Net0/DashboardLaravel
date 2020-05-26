<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesAndPermissions = config('access.roles_and_permissions');
        $roles = config('access.roles');
        $permissions = config('access.permissions');

        DB::transaction(function () use ($rolesAndPermissions, $roles, $permissions) {
            foreach (Role::all() as $role) {
                foreach ($role->permissions as $permission)
                    $permission->delete();

                $role->delete();
            }

            foreach ($rolesAndPermissions as $key => $roleAndPermissions) {
                $role = Role::create(['name' => $key]);

                foreach ($roleAndPermissions as $permission) {
                    if (is_null(Permission::where('name', $permission)->first()))
                        Permission::create(['name' => $permission]);

                    if ($key !== 'super-admin')
                        $role->givePermissionTo($permission);
                }
            }

            foreach ($roles as $role)
                if (is_null(Role::where('name', $role)->first()))
                    Role::create(['name' => $role]);

            foreach ($permissions as $permission)
                if (is_null(Permission::where('name', $permission)->first()))
                    Permission::create(['name' => $permission]);

            $role = Role::findByName('super-admin');
            $role->givePermissionTo(Permission::all());
        });
    }
}
