<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin
        $superAdmin = User::create([
            'system_code' => 'WSA-01',
            'role' => 'super_admin',
            'password' => Hash::make('Admin@123'),
            'real_name' => 'System Administrator', // Will be encrypted
            'wallet_balance' => 0,
            'is_active' => true
        ]);
        
        // Create Sample Manager
        $manager = User::create([
            'system_code' => 'WSM-101',
            'role' => 'manager',
            'password' => Hash::make('Manager@123'),
            'real_name' => 'John Manager',
            'parent_code' => 'WSA-01',
            'created_by' => 'WSA-01',
            'wallet_balance' => 0,
            'is_active' => true
        ]);
        
        // Create Sample Provider
        $provider = User::create([
            'system_code' => 'WSP-2001',
            'role' => 'provider',
            'password' => Hash::make('Provider@123'),
            'real_name' => 'Sarah Provider',
            'parent_code' => 'WSM-101',
            'created_by' => 'WSM-101',
            'wallet_balance' => 0,
            'is_active' => true
        ]);
        
        // Create Sample Client
        $client = User::create([
            'system_code' => 'WSC-90001',
            'role' => 'client',
            'password' => Hash::make('Client@123'),
            'real_name' => null, // Anonymous client
            'parent_code' => 'WSP-2001',
            'created_by' => 'WSP-2001',
            'wallet_balance' => 1000.00, // Starting credit
            'is_active' => true
        ]);
        
        // System Configuration
        \DB::table('system_config')->insert([
            [
                'config_key' => 'platform.default_commission',
                'config_value' => '15',
                'data_type' => 'number',
                'description' => 'Default platform commission percentage'
            ],
            [
                'config_key' => 'booking.cancellation_window_hours',
                'config_value' => '24',
                'data_type' => 'number',
                'description' => 'Hours before slot for free cancellation'
            ],
            [
                'config_key' => 'privacy.client_name_optional',
                'config_value' => 'true',
                'data_type' => 'boolean',
                'description' => 'Whether clients can skip real name'
            ]
        ]);
    }
}
