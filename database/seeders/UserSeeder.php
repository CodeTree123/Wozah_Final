<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'role_id' => '1',
            'first_name' => 'Wozah',
            'last_name' => 'Admin',
            'email' => 'admin@wozah.com',
            'password' => Hash::make('rootadmin'),
            'email_verified_at' => now(),
            'user_status' => '1'
        ]);
    }
}
