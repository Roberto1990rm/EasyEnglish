<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'robertoramirezmoreno@gmail.com',
            'password' => Hash::make('12345678'),
            'admin' => 1,
        ]);
    }
}
