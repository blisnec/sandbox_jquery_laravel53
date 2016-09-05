<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleUser = ["admin" => "admin", "moderator" => "moderator", "user" => "employee"];

        $roles = [];
        $data = Role::all();
        foreach ($data as $role) {
            $roles[$role->name] = $role->id;
        }

        $users = [];
        $data = User::all();
        foreach ($data as $user) {
            $users[$user->name] = $user->id;
        }

        foreach ($roleUser as $user => $role) {
            DB::table('role_user')->insert([
                'user_id' => $users[$user],
                'role_id' => $roles[$role],
            ]);
        }
    }
}
