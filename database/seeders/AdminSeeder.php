<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'loginid' => 'admin',
            'password' => Hash::make('12345678'),
            'device_limit' => 2,
            'role' => 'admin',
            'cby' => 'admin'
        ]);
    }
}
