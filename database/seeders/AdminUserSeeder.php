<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@santal.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);
        // User::create([
        //     'name' => 'Super Admin',
        //     'email' => 'superadmin@santal.com',
        //     'password' => Hash::make('superadmin123'),
        //     'role' => 'admin'
        // ]);
        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: admin@santal.com | Password: admin123');
        //$this->command->info('Email: superadmin@santal.com | Password: superadmin123');

    }
}
