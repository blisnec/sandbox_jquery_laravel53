<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Permission;
use App\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionRole = [
            "admin"     => ["user-list", "user-create", "user-edit", "user-delete",
                            "role-list", "role-create", "role-edit", "role-delete",
                            "item-list", "item-create", "item-edit", "item-delete",
            ],
            "owner"     => ["user-list", "user-create", "user-edit", "user-delete",
                            "item-list",
            ],
            "moderator" => ["item-list"],
            "employee"  => ["item-list"],
        ];

        $permissions = [];
        $data = Permission::all();
        foreach ($data as $permission) {
            $permissions[$permission->name] = $permission->id;
        }

        $roles = [];
        $data = Role::all();
        foreach ($data as $role) {
            $roles[$role->name] = $role->id;
        }

        foreach ($permissionRole as $key => $value) {
            foreach ($value as $permission) {
                DB::table('permission_role')->insert([
                    'permission_id' => $permissions[$permission],
                    'role_id' => $roles[$key],
                ]);
            }
        }
    }
}
