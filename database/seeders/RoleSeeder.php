<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::truncate(); 
        Role::query()->delete();

        $roles = [
            [
                'name' => 'admin',
            ],
            [
                'name' => 'organizer',
            ],
            [
                'name' => 'user',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
