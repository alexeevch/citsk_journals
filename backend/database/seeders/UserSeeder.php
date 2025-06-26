<?php

namespace Database\Seeders;

use App\Constants;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => env('USER_ROOT_EMAIL')],
            [
                'email'      => env('USER_ROOT_EMAIL'),
                'password'   => Hash::make(env('USER_ROOT_PASSWORD')),
                'last_name'  => env('USER_ROOT_LAST_NAME'),
                'first_name' => env('USER_ROOT_FIRST_NAME'),
                'post'       => env('USER_ROOT_POST'),
                'is_blocked' => false
            ]);

        $user->assignRole(Constants::ROOT_ROLE);
    }
}
