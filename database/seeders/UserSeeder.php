<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin por defecto
        User::create([
            'name' => 'root',
            'email' => 'root@admin.com',
            'password' => bcrypt('1q2w3e4r5t')
        ])->assignRole('Admin');
        //Creador por defecto
        User::create([
            'name' => 'creador',
            'email' => 'creador@admin.com',
            'password' => bcrypt('1q2w3e4r5t')
        ])->assignRole('Creador');
        // Editor por defecto
        User::create([
            'name' => 'editor',
            'email' => 'editor@admin.com',
            'password' => bcrypt('1q2w3e4r5t')
        ])->assignRole('Editor');
        // User por defecto
        User::create([
            'name' => 'user',
            'email' => 'user@admin.com',
            'password' => bcrypt('1q2w3e4r5t')
        ])->assignRole('User');

        User::factory(9)->create();
    }
}
