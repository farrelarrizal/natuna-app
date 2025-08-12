<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->truncate();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 'SUPERADMIN'
        ]);

        
    }
}
