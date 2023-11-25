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
        $adminRecords = ['name' => 'Super Admin', 'type' => 'superadmin', 'vendor_id' => 0, 'mobile' => '1234567890', 'email' => 'admin@gmail.com', 'password' => 'admin', 'image' => '', 'status' => 1];

        Admin::create($adminRecords);
    }
}
