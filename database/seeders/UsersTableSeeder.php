<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $role = role::where('name','super Admin')->firstOrFail();
        User::create([
            'name' => 'Super Admin User',
            'email' => 'super-admin-user@example.com',
            'password' => Hash::make('password'),
            'role_id' =>  $role->id
        ]);
    }
}
