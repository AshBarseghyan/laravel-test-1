<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //create 5 test users
        $users = [
            [
                'name' => 'John Doe 1',
                'email' => 'test1@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Jane Doe 2',
                'email' => 'test2@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'John Doe 3',
                'email' => 'test3@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'John Doe 4',
                'email' => 'test4@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'John Doe 5',
                'email' => 'test5@gmail.com',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $user) {
            $user = \App\Models\User::create($user);

            //assign role to user
            $user->assignRole('admin');
        }
    }
}
