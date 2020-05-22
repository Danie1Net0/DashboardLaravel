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

        DB::transaction(function () use ($rolesAndPermissions) {
            foreach (Role::all() as $role) {
                foreach ($role->permissions as $permission) {
                    $permission->delete();
                }

                $role->delete();
            }

            foreach ($rolesAndPermissions as $key => $roleAndPermissions) {
                $role = Role::create(['name' => $key]);

                foreach ($roleAndPermissions as $permission) {
                    Permission::create(['name' => $permission]);

                    if ($key !== 'admin') {
                        $role->givePermissionTo($permission);
                    }
                }
            }

            $role = Role::findByName('admin');
            $role->givePermissionTo(Permission::all());
        });
    }
}
