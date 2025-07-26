<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(9)->create();

        User::factory()->create([
            'name' => 'Gaby',
            'email' => 'gaby@tema.com',
            'password' => Hash::make('gaby123'), // or use bcrypt('gaby123')
        ]);
    }
}
