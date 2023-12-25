<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $adminRecords = ['name' => 'Super Admin', 'type' => 'superadmin', 'vendor_id' => 0, 'mobile' => '1234567890', 'email' => 'admin@gmail.com', 'password' => 'admin@123', 'image' => '', 'status' => 1];
        $adminRecords = ['name' => 'John', 'type' => 'vendor', 'vendor_id' => 1, 'mobile' => '9800000000', 'email' => 'john@gmail.com', 'password' => 'john@123', 'image' => '', 'status' => 0];

        Admin::create($adminRecords);
    }
}
