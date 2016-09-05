<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                "name"         => "admin",
                "display_name" => "Администратор",
                "description"  => "Имеет все права.",
            ],
            [
                "name"         => "owner",
                "display_name" => "Владелец",
                "description"  => "Может создавать/редактировать/удалять задачи, а также создавать пользователей.",
            ],
            [
                "name"         => "moderator",
                "display_name" => "Модератор",
                "description"  => "Может просматривать все задачи.",
            ],
            [
                "name"         => "employee",
                "display_name" => "Пользователь(СМ)",
                "description"  => "Может просматривать только свои задачи.",
            ],
        ];

        foreach ($role as $key => $value) {
            Role::create($value);
        }
    }
}
