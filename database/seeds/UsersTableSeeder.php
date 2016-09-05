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
                'name'     => 'admin',
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => bcrypt('admin'),
            ],
            [
                'name'     => 'moderator',
                'username' => 'moderator',
                'email'    => 'moderator@example.com',
                'password' => bcrypt('moderator'),
            ],
            [
                'name'     => 'user',
                'username' => 'user',
                'email'    => 'user@example.com',
                'password' => bcrypt('user'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
