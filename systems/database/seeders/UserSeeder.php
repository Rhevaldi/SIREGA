<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
      
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superadmin']);
        $roleAdmin      = Role::firstOrCreate(['name' => 'admin']);
        $roleWarga      = Role::firstOrCreate(['name' => 'warga']);

        // =====================
        // SUPER ADMIN
        // =====================
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superadmin->syncRoles([$roleSuperAdmin]);

        // =====================
        // ADMIN
        // =====================
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin RT',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles([$roleAdmin]);

        // =====================
        // WARGA
        // =====================
        $warga = User::firstOrCreate(
            ['email' => 'warga@example.com'],
            [
                'name' => 'Warga',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $warga->syncRoles([$roleWarga]);
    }
}
