<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'ADMIN']);
        Role::create(['name' => 'EDITOR']);
        Role::create(['name' => 'LECTOR']);

        User::create([
            'name' => 'Marcos Carrasco',
            'email' => 'marcos@admin.com',
            'password' => Hash::make('Ecuador.2024/')
        ])->assignRole('ADMIN');
    }
}
