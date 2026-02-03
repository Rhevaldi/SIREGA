<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $superadmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);
        $admin = User::factory()->create([
            'name' => 'Admin RT',
            'email' => 'admin@example.com',
        ]);

        $warga = User::factory()->create([
            'name' => 'Warga',
            'email' => 'warga@example.com',
        ]);

        $roleSuperAdmin = Role::create([
            'name' => 'superadmin'
        ]);
        $roleAdmin = Role::create([
            'name' => 'admin'
        ]);
        $roleWarga = Role::create([
            'name' => 'warga'
        ]);

        $superadmin->assignRole($roleSuperAdmin);
        $admin->assignRole($roleAdmin);
        $warga->assignRole($roleWarga);
    }
}
