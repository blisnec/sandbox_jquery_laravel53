<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'fio'      => 'admin',
                'branch'   => 0,
                'email'    => 'admin@example.com',
                'phone'    => '223322',
                'status'   => 1,
            ],
            [
                'username' => 'moderator',
                'password' => bcrypt('moderator'),
                'fio'      => 'moderator',
                'branch'   => 0,
                'email'    => 'moderator@example.com',
                'phone'    => '332233',
                'status'   => 1,
            ],
            [
                'username' => 'user',
                'password' => bcrypt('user'),
                'fio'      => 'user',
                'branch'   => 0,
                'email'    => 'user@example.com',
                'phone'    => '223322',
                'status'   => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
