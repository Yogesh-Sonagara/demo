<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            'name' => 'John', 'address' => 'CP-112', 'city' => 'New Delhi', 'state' => 'Delhi', 'country' => 'India', 'pincode' => '110001', 'mobile' => '9800000000', 'email' => 'john@gmail.com', 'status' => 0
        ];

        Vendor::create($vendorRecords);
    }
}
