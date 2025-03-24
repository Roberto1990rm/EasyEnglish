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
            'name' => 'Super Admin',
            'email' => 'admin@easyenglish.com',
            'password' => bcrypt('admin123'),
            'admin' => 1,
            'subscriber' => 1,
        ]);
        
    }
}
