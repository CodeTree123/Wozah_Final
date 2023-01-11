<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        role::create([
            'role' => 'Admin',
        ]);
        role::create([
            'role' => 'Shop',
        ]);
        role::create([
            'role' => 'Individual',
        ]);
        role::create([
            'role' => 'Customer',
        ]);
        role::create([
            'role' => 'Employee',
        ]);
        
    }
}
