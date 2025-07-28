<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = env('ADMIN_USER', 'admin');
        $adminPass = env('ADMIN_PASS', 'password');
        \App\Models\User::updateOrCreate(
            ['name' => $adminUser],
            [
                'password' => bcrypt($adminPass),
            ]
        );
    }
}
